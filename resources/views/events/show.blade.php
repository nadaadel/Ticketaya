@extends('layouts.app')
@section('content')

     {{ $event-> name}} EVENT <br>
     <fieldset>
            <legend style="background-color: gray">Event Info </legend>
            <img src="{{ asset('storage/images/events/'. $event->photo) }}" style="width:150px; height:150px;">
            <p>Name : {{ $event->name }}</p>
            <p>Quantity:{{ $event->avaliabletickets }}</p>
            <p>Description:{{ $event->description }}</p>
            <p>Start Date :{{ $event->startdate }}</p>
            <p>End Date :{{ $event->enddate }}</p>
            <p>Category :{{ $event->category->name }}</p>
            @if($event->city_id)
            <p>Location:{{ $event->region->name }},{{ $event->city->name }}</p>
            @endif
            <p>Created by :{{ $event->user->name }} </p>
           <hr>
        </fieldset>

    @if(Auth::user() && Auth::user()->id == $event->user_id)
     <button id="showModel" class="btn btn-primary"> Add New Info </button>
     <div class="info-area" style="display:none;">
            <textarea class="info-body" cols="9">

            </textarea>
            <button id="info-submit" class="btn btn-info">Post</button>
     </div>
    @endif
    {{-- info --}}
  <div class="info-parent" >
        Post of Event:
        @foreach ($eventInfos as $info )
      
        <div class="event-info" id="{{$info->id}}" style="display:block;">
            <p class="event-body">{{$info->body}} <p>
            <p class="event-time">{{$info->created_at->diffForHumans()}} <p>
            @if(Auth::user() && Auth::user()->id == $event->user_id)
             <button class='deleteinfo' btn-id ="{{$info->id}}">delete</button>
            @endif
        <div>
         
        
        <hr>
       @endforeach
  </div>

   {{-- end info section --}}

{{-- questions and answer --}}
@if($questions)
@foreach($questions as $question)
<div class="questions">
    <div id ="{{$question->id}}}">
        Question<p>{{$question->question}} </p>
        Answer: <p>{{$question->answer}} </p>
    </div>
</div>

@if(Auth::user() && Auth::user()->id == $event->user_id)

 <button class="answer-submit" question-id="{{$question->id}}" question="{{$question->question}}" questioner="{{$question->user_id}}" class="btn btn-info">Answer</button>
 <div class="answer-area" >
        <textarea class="ans-body" id="{{$question->id}}"  cols="12">
        </textarea>

 </div>
    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
    <input type="hidden" id="event_id" value="{{$event->id}}">
@endif

<hr>
@endforeach
@endif

    {{--  Subscribe and Unsubscribe--}}
    @if(Auth::user() && Auth::user()->id != $event->user_id)
        @if(sizeof($subscribers) == 1)

        <button id="subscribe" class="btn btn-danger" >unsubscribe</button>
        @else
        <button id="subscribe" class="btn btn-primary " >subscribe</button>
        @endif

          {{--  add Question --}}
        <button id="questionbtn" class="btn btn-primary" >Question !</button>
        <div class="question-area" style="display:none;">
                <textarea id="ques-body" cols="12">
                </textarea>
                <button id="question-submit" class="btn btn-info">Post</button>
        </div>

    @endif
    @if(Auth::user())
     <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
    @endif

     <input type="hidden" id="event_id" value="{{$event->id}}">
<script>
    $(document).ready(function(){

    $('#questionbtn').on('click',function(){
        $('.question-area').show();
    });

    $('#question-submit').on('click',function(){

        var body=$('#ques-body').val();
        var user_id = $('#user_id').val();
        var event_id = $('#event_id').val();
        var no=$('.allquestion').attr('question-no');

        $('.question-area').hide();
        $.ajax({
            url: '/events/question/'+event_id+'/'+user_id,
               type: 'GET' ,
               data:{
                '_token':'@csrf',
                'question':body,
                'event_id':event_id,
                'user_id':user_id,
                },
                success:function(response){
                 if(response.response == 'success'){
                    console.log(response.questions)
                    //alert('saved Questions Successfuly')
                 $("<div id='"+response.questions.id+"'></div>").prependTo('.questions');
                  $('#'+response.questions.id).append("Question:<p class='event-body'>"+response.questions.question+"</p><hr>")
                 }
                }
        });
    });

    $('.answer-submit').on('click',function(){
     var quesId=$(this).attr('question-id');
     var question=$(this).attr('question');
     var questioner=$(this).attr('questioner');
     var body=$('#'+quesId).val();
     var event_id = $('#event_id').val();
      $.ajax({
            url: '/events/answer/'+event_id+'/'+user_id,
               type: 'GET' ,
               data:{
                '_token':'@csrf',
                'question':question,
                'event_id':event_id,
                'user_id':questioner,
                'answer':body,
                'quesId':quesId,
                },
                success:function(response){
                if(response.response== 'success'){
                    console.log("kkkk");
                    console.log(response);
                   console.log( $('#'+response.answer.id).append( "Answer:<p class='event-body'>"+response.answer.answer+"</p><hr>" ));


                }
                }

        })


  })

    $('#subscribe').on('click' , function(){

         var user_id = $('#user_id').val();
         var event_id = $('#event_id').val();
         console.log($(this).html())
         if ($(this).html()=="subscribe"){
             console.log("hiii")
             $.ajax({
               url: '/events/subscribe/'+event_id+'/'+user_id,
               type: 'GET' ,
               data:{
                '_token':'@csrf'
                },


            success:function(response){
             console.log(response);

            if(response.status == 'success'){
               $('#subscribe').html('unsubscribe');
               console.log('success');
              $('#subscribe').attr('class' , 'btn btn-danger');
             }
         }



         });
    }
    else{

         $.ajax({
               url: '/events/unsubscribe/'+event_id+'/'+user_id,
               type: 'GET' ,
               data:{
                '_token':'@csrf'
                },


            success:function(response){
             console.log(response);

            if(response.status == 'success'){
               $('#subscribe').html('subscribe');
               console.log('success');
              $('#subscribe').attr('class' , 'btn btn-primary');
             }
         }



         });

    }




        });



    $('#showModel').on('click' , function(){
        $('.info-area').show();
        $(this).hide();
    });

    $('#info-submit').on('click' , function(){
       var description = $('.info-body').val();
       
       console.log(description);
       var event_id = $('#event_id').val();
       console.log(event_id);
       $.ajax({
           url: '/events/info/new/'+event_id,
           type:'POST',
           data:{
               '_token': '{{csrf_token()}}',
               'description':description
           },
        success:function(response){

            if(response.status == 'success'){
                console.log('ok')
                $( "<div id='"+response.id+"'></div" ).prependTo(".info-parent" );
                $('#'+response.id).append("<p class='event-body'>"+description+"</p>")
                $('#'+response.id).append( "<p class='event-time'>"+response.time.date+"</p>" );
                $('#'+response.id).append("<button class='deleteinfo' btn-id='"+response.id+"'>Delete</button>");
               
                $('.info-area').hide();
                $('#showModel').show();
                $('.deleteinfo').on('click',function(){
        var id =$(this).attr('btn-id');
        console.log(id)
        $.ajax({
           url: '/events/info/delete/'+id,
           type:'POST',
           data:{
               '_token': '{{csrf_token()}}',
               '_method':'DELETE',
               
           },
        success:function(response){

            if(response.response == 'success'){
                console.log('pl')
                $('#'+id).remove();
                

        }
       }
        })
    })
            }else{
             alert('error');
            }

        }
       })
    });
    $('.deleteinfo').on('click',function(){
        var id =$(this).attr('btn-id');
        console.log(id)
        $.ajax({
           url: '/events/info/delete/'+id,
           type:'POST',
           data:{
               '_token': '{{csrf_token()}}',
               '_method':'DELETE',
               
           },
        success:function(response){

            if(response.response == 'success'){
                console.log('pl')
                $('#'+id).remove();
                

        }
       }
        })
    })

   });

</script>
@endsection
