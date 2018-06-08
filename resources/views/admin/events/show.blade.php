@extends('admin.index')
@section('content')

     {{ $event-> name}} EVENT <br>
    
    @if(Auth::user() && Auth::user()->id == $event->user_id)
     <button id="showModel" class="btn btn-primary"> Add New Info </button>
     <div class="info-area" style="display:none;">
            <textarea class="info-body" cols="9">

            </textarea>
            <button id="info-submit" class="btn btn-info">Post</button>
     </div>
    @endif
    {{-- info --}}
  <div class="info-parent">
        @foreach ($eventInfos as $info )
        <div class="event-info" style="display:block;">
            Post of Event<p class="event-body">{{$info->body}} <p>
            <p class="event-time">{{$info->created_at->diffForHumans()}} <p>
            

        <div>
       @endforeach
  </div>
  <hr>
  {{-- questions and answer --}}
  @if($questions)
    @foreach($questions as $question)
    <div id="allquestion">
     Question<div class="question" ques-id="{{$question->id}}">{{$question->question}} </div>
     <div class="answer"  >{{$question->answer}} </div>
     @if(Auth::user() && Auth::user()->id == $event->user_id)
     <button class="answer-submit" question-id="{{$question->id}}" question="{{$question->question}}" questioner="{{$question->user_id}}" class="btn btn-info">Answer</button>
     <div class="answer-area" >
            <textarea class="ans-body" id="{{$question->id}}"  cols="12">
            </textarea>
            
      </div>
     

    </div>
      @endif
      <hr>

    @endforeach
   @endif 
  

    @if(Auth::user() && Auth::user()->id != $event->user_id)
      @if(sizeof($subscribers) == 1)

     <button id="subscribe" class="btn btn-danger" >unsubscribe</button>
      @else
      <button id="subscribe" class="btn btn-primary " >subscribe</button>
      @endif
      

      <button id="questionbtn" class="btn btn-primary" >Question !</button>
      <div class="question-area" style="display:none;">
            <textarea id="ques-body" cols="12">
            </textarea>
            <button id="question-submit" class="btn btn-info">Post</button>
      </div>

    @endif

  <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
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
        var quesId=$('.question').attr('ques-id');
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

                  console.log(response);
                 //$('#'+quesId).append('<div>'+response.question.question+'</div>');
                 

                }

        })


    })
    $('.answer-submit').on('click',function(){
     var quesId=$(this).attr('question-id');
     var question=$(this).attr('question');
     var questioner=$(this).attr('questioner');
      var body=$('#'+quesId).val();
     // var user_id = $('#user_id').val();
      var event_id = $('#event_id').val();
      console.log(question);
      console.log(event_id);
      console.log(quesId);
      console.log(questioner);

    
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

                  console.log(response);
                 //$('#'+quesId).append('<div>'+response.question.question+'</div>');
                 

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
       //var description = $('.info-body').val();
       alert('hello');
       //console.log(description);
       var event_id = $('#event_id').val();
       console.log("xx"+event_id);
       /*$.ajax({
           url: '/events/info/new/'+event_id,
           type:'POST',
           data:{
               '_token': '{{csrf_token()}}',
               'description':description
           },
        success:function(response){
            if(response.status == 'success'){
                console.log(success)
                $( "<div id='event-info'><p class='event-time'>about minute ago</p></div>" ).prependTo(".info-parent" );
                $( "<div id='event-info'><p class='event-body'>"+description+"</p></div>" ).prependTo(".info-parent" );
                $('.info-area').hide();
                $('#showModel').show();
            }else{
             alert('error');
            }

        }
       })*/
    });

   });

</script>
@endsection
