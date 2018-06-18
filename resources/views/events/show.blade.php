@extends('layouts.app')
@section('content')
     <section id="event-view">
       <div class="contaner-fluid"  style="background-image: url(../images/home/concert.jpeg);">
         <div class="overlay"></div>
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-md-8">
                      <div class="row pt-5 pb-4">
                          <div class="col-md-8 col-12">
                              <h2>{{ ucwords($event->name )}}</h2>
                              <ul>
                                  <li><i class="fas fa-ticket-alt"></i> Available Tickets <span>{{ $event->avaliabletickets }}</span></li>
                                  <li><i class="fas fa-th-large"></i> {{ ucwords($event->category->name) }} </li>
                                  <li><i class="far fa-calendar-alt"></i>Posted at : {{ \Carbon\Carbon::parse($event->startdate)->diffForHumans() }} </li>
                                  <li><i class="far fa-calendar-alt"></i>expire at : {{ \Carbon\Carbon::parse($event->enddate)->diffForHumans() }} </li>
                                  @if($event->city_id)
                                  <li><i class="fas fa-map-marker"></i>{{ $event->region->name }},{{ $event->city->name }} </li>
                                  @endif
                              </ul>
                  
            
                          </div>
                          <div class="col-md-4 col-12">
                          @if(Auth::user() && Auth::user()->id != $event->user_id)
                           @if(sizeof($subscribers) == 1)

                             <button id="subscribe" class="btn btn-danger" >unsubscribe</button>
                             @else
                            <button id="subscribe" class="btn btn-primary " >subscribe</button>
                             @endif
                          @endif
                         
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
                               <h4 class="user-name pt-4">{{ $event->user->name }}</h4>
                               <div class="user-loc d-flex justify-content-center">
                               <p class="gray">{{ $event->user->city}},{{ $event->user->region }} </p>
                           </div>
                             <a href="{{ URL::to('users/' . $event->user->id ) }}" class="btn  edit-btn">Conatct Organizer</a>
                       </div><!--End of User profile-->
                <div class="col-md-10 pb-5"><!--Event data-->
                    <div class="row">
                        <div class="col-md-6 col-xs-12 event-details pl-4">
                           <h3 class="mb-3">Event Details</h3>
                            <p>
                               {{$event->description}}
                            </p>
                            
                            <h3 class="mb-3">You Should Know</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                            </p>
                            @if(Auth::user() && Auth::user()->id == $event->user_id)
                               <button id="showModel" class="btn btn-primary"> Add New Info </button>
                               <div class="info-area" style="display:none;">
                                  <textarea  class="info-body form-control txt-area" placeholder="Please Add New Post ...">

                                  </textarea>
                                  <button id="info-submit" class="btn btn-info">Post</button>
                                </div>
                            @endif
                            <div class="info-parent" >
   
                              @foreach ($eventInfos as $info )
      
                               <div class="event-info" id="{{$info->id}}" style="display:block;">
                                    <p class="event-body">{{$info->body}} <p>
                                    <p class="event-time">{{$info->created_at->diffForHumans()}} <p>
                                   @if(Auth::user() && Auth::user()->id == $event->user_id)
                                         <button class='deleteinfo' btn-id ="{{$info->id}}">delete</button>
                                   @endif
                                </div>
         
        
                              
                            @endforeach
                            </div>
                            {{ $eventInfos->links() }}
                        </div>
                        <div class="col-md-6 col-xs-12 pr-2">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6818.152267792459!2d30.058911199999997!3d31.301640799999998!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1529197337727" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user() && Auth::user()->id != $event->user_id)
             <button id="questionbtn" class="btn btn-primary" >Question !</button>
             <div class="question-area" style="display:none;">
                <textarea id="ques-body" class="form-control txt-area" placeholder=" Add New Question ...">
                </textarea>
                <button id="question-submit" class="btn btn-info">Post</button>
            </div>

        @endif
        @if(Auth::check())
            <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
        @endif

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
            <textarea class="ans-body form-control txt-area" placeholder=" Add New Question ..." id="{{$question->id}}"  cols="12">
            </textarea>

            </div>
             <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" id="event_id" value="{{$event->id}}">
        @endif

            <hr>
        @endforeach
        @endif
        
         
     </section>


    


{{-- questions and answer --}}



   

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
