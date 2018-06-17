@extends('layouts.app')
@section('content')
     <section id="event-view">
       <div class="contaner-fluid"  style="background-image: url(../images/home/2-silder.jpg);">
         <div class="overlay"></div>
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-md-8">
                      <div class="row pt-5 pb-4">
                          <div class="col-md-8 col-12">
                              <h2> Amr Diab Marina Concert</h2>
                              <ul>
                                  <li><i class="fas fa-ticket-alt"></i> Available Tickets <span>200</span></li>
                                  <li><i class="fas fa-th-large"></i> Concert </li>
                                  <li><i class="far fa-calendar-alt"></i>Posted at : Sat, 12 Nov 2018 </li>
                                  <li><i class="far fa-calendar-alt"></i>expire at : Sat, 12 Nov 2018 </li>
                                  <li><i class="fas fa-map-marker"></i>Marina no 5, Nourth Coast </li>
                              </ul>

                          </div>
                          <div class="col-md-4 col-12">
                              <a href="#" class="btn btn-primary">SUBSCRIBE</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
           
       </div>
        <div class="container">
            <div class="row pt-5 event-info">
                 <div class="col-md-2 col-xs-12 text-center"><!--User profile-->
                           <div class="user-img">
                               <div style="background-image: url(../images/icons/avatar.jpg);"></div><!--User logged img-->

                            </div>
                               <h4 class="user-name pt-4">Event Creator</h4>
                               <div class="user-loc d-flex justify-content-center">
                               <p class="gray">Alexandria</p>
                           </div>
                           <button class="btn btn-info"> Contact Organizer </button>
                       </div><!--End of User profile-->
                <div class="col-md-10 pb-5"><!--Event data-->
                    <div class="row">
                        <div class="col-md-6 col-xs-12 event-details pl-4">
                           <h3 class="mb-3">Event Details</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                            </p>
                            <p class="mb-5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                            </p>
                            <h3 class="mb-3">You Should Know</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                            </p>
                        </div>
                        <div class="col-md-6 col-xs-12 pr-2">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6818.152267792459!2d30.058911199999997!3d31.301640799999998!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1529197337727" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            
        </div>
         
     </section>

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
  <div class="info-parent">
        @foreach ($eventInfos as $info )
        <div class="event-info" style="display:block;">
            Post of Event<p class="event-body">{{$info->body}} <p>
            <p class="event-time">{{$info->created_at->diffForHumans()}} <p>


        <div>
       @endforeach
  </div>

   {{-- end info section --}}

{{-- questions and answer --}}
@if($questions)
@foreach($questions as $question)
<div id="{{$question->id}}">
Question<div class="question">{{$question->question}} </div>
Answer: <div class="answer"  >{{$question->answer}} </div>


@if(Auth::user() && Auth::user()->id == $event->user_id)

 <button class="answer-submit" question-id="{{$question->id}}" question="{{$question->question}}" questioner="{{$question->user_id}}" class="btn btn-info">Answer</button>
 <div class="answer-area" >
        <textarea class="ans-body" id="{{$question->id}}"  cols="12">
        </textarea>

 </div>
    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
    <input type="hidden" id="event_id" value="{{$event->id}}">
@endif
</div>
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
                 if(response.response== 'success'){
                    alert('saved Questions Successfuly')
                  $("<div class='question'>Question:<p class='event-body'>"+response.questions.question+"</p></div><hr>" ).prependTo('.questions-area');

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

                  console.log(response);
                  $( "<div class='answer'>Answer:<p class='event-body'>"+response.answer.answer+"</p></div><hr>" ).prependTo('.questions-area');


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
       alert("helllo");
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
                $( "<div id='event-info'><p class='event-time'>about minute ago</p></div>" ).prependTo(".info-parent" );
                $( "<div id='event-info'><p class='event-body'>"+description+"</p></div>" ).prependTo(".info-parent" );
                $('.info-area').hide();
                $('#showModel').show();
            }else{
             alert('error');
            }

        }
       })
    });

   });

</script>
@endsection
