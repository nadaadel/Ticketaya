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

                             <button id="subscribe" class="btn btn-danger" >Unsubscribe</button>
                             @else
                            <button id="subscribe" class="btn btn-primary " >Subscribe</button>
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
                               <p class="gray">{{ $event->user->city->name }}</p>
                           </div>
                             <a href="{{ URL::to('users/' . $event->user->id ) }}" class="btn  btn-secondary">Conatct Organizer</a>
                       </div><!--End of User profile-->
                <div class="col-md-10 pb-5"><!--Event data-->
                    <div class="row">
                        <div class="col-md-6 col-xs-12 event-details pl-4">
                           <h3 class="mb-3">Event Details</h3>
                            <p>
                               {{$event->description}}
                            </p>

                            <h3 class="mb-3">You Should Know</h3>
                            <p>                                    We are an intermediate between seller and you to help you find your request and get all operation more easier to get your satisfy.

                            </p>

                        </div>
                        <div class="col-md-6 col-xs-12 pr-2">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6818.152267792459!2d30.058911199999997!3d31.301640799999998!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1529197337727" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container posts">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12 mt-5 mb-3">
                    <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-post-tab" data-toggle="tab" href="#nav-post" role="tab" aria-controls="nav-post" aria-selected="true">Event Organizers Posts</a>
                        <a class="nav-item nav-link" id="nav-questions-tab" data-toggle="tab" href="#nav-questions" role="tab" aria-controls="nav-questions" aria-selected="false">Questions & Answers</a>

                      </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-post" role="tabpanel" aria-labelledby="nav-post-tab"><!-- posts tab-->
                          <div class="row justify-content-center">
                                <div class="col-md-10 col-12">
                                  <div class="row">
                                      <div class="col-md-12 mt-3">
                                             @if(Auth::user() && Auth::user()->id == $event->user_id)
                                               <button id="showModel" class="btn btn-primary "> Add New Info </button>
                                               <div class="info-area" style="display:none;">
                                                  <div class="">
                                                      <textarea  class="info-body form-control txt-area w-50" placeholder="Please Add New Post...">

                                                      </textarea>
                                                      <button id="info-submit" class="btn btn-info mt-2">Post</button>
                                                  </div>
                                                </div>
                                            @endif
                                      </div>
                                  </div>
                                         @if(!$eventInfos->isEmpty())
                                            <div class="info-parent" >


                                              @foreach ($eventInfos as $info )

                                               <div class="event-info" id="{{$info->id}}" style="display:block;">
                                               <div class="row">
                                                   <div class="col-md-8">
                                                       <h4 class="event-body">{{$info->body}} <h4>
                                                        <p class="event-time"><span>Posted at</span> {{$info->created_at->diffForHumans()}} <p>
                                                   </div>
                                                    <div class="col-md-4">
                                                       @if(Auth::user() && Auth::user()->id == $event->user_id)
                                                             <button class="deleteinfo btn btn-danger float-right" btn-id ="{{$info->id}}">delete</button>
                                                       @endif
                                                   </div>
                                               </div>
                                                </div>



                                            @endforeach
                                            </div>
                                            <div class="pagenation">
                                                {{ $eventInfos->links() }}
                                            </div>


                                            @else
                                            <div class="text-center">
                                                <h3 class="mt-5 mb-5">
                                                    No Posts Created by event Organizers
                                                </h3>
                                            </div>
                                            @endif

                                </div>
                            </div>
                      </div><!-- end ofposts tab-->
                      <div class="tab-pane fade" id="nav-questions" role="tabpanel" aria-labelledby="nav-questions-tab"><!-- questions tab-->
                          <div class="row justify-content-center">
                               <div class="col-md-10 col-12">
                                @if(Auth::user() && Auth::user()->id != $event->user_id)
                                     <button id="questionbtn" class="btn btn-primary mb-3 mt-4" >Do You Have a Question ?</button>
                                     <div class="question-area" style="display:none;">
                                        <textarea id="ques-body" class="form-control txt-area" placeholder=" Add New Question ...">
                                        </textarea>
                                        <button id="question-submit" class="btn btn-info mt-2">Post</button>
                                    </div>
                                @endif
                                @if(Auth::check())
                                    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                                @endif
                                <div class="questions mt-3" >
                                @if($questions)
                                    @foreach($questions as $question)
                                        <div id="{{$question->id}}">
                                        @if(Auth::user() && (Auth::user()->id == $question->user_id ||Auth::user()->id == $event->user_id||Auth::user()->hasRole('admin')))
                                        <button class="deletQues btn  btn-danger float-right" delete-ques="{{$question->id}}">delete</button>
                                        @endif
                                              Question<h4>{{$question->question}} ?</h4>
                                              Answer: <p>{{$question->answer}} </p>
                                @if(Auth::user() && Auth::user()->id == $event->user_id)
                                    <div class="answer-area" >
                                    <textarea class="ans-body form-control txt-area" id={{$question->id}} placeholder=" Add Answer  ..." >
                                    </textarea>
                                    </div>
                                    <button class="answer-submit btn btn-info mt-2" question-id="{{$question->id}}" question="{{$question->question}}" questioner="{{$question->user_id}}" >Answer</button>
                                     <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" id="event_id" value="{{$event->id}}">
                                @endif
                                    <hr>
                                </div>
                                @endforeach
                                <div class="pagenation">
                                {{ $questions->links() }}
                                </div>
                                @endif
                            </div>
                            </div>
                        </div>
                      </div><!-- end of questions tab-->

                    </div>
                </div>
            </div>
        </div>


     </section>





     <input type="hidden" id="event_id" value="{{$event->id}}">
<script>
    $(document).ready(function(){

    $('#questionbtn').on('click',function(){
        $('#ques-body').val('');
        $('.question-area').show();
    });
    $(document).on('click','.deletQues',function(){
        var question_id=$(this).attr('delete-ques');
        $.ajax({
            url: '/questions/delete/'+question_id,
            type: 'POST' ,
            data:{
                'id':question_id,
                '_token': '{{csrf_token()}}',
                '_method':'DELETE'
                },
            success:function(response){
                console.log($('#'+question_id));
                $('#'+question_id).remove();
            }

        })
    })
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
                    var question=response.questions;
                    $(`<div id=`+question.id+`>
                            <button class="deletQues btn  btn-danger float-right" delete-ques=`+question.id+`>
                            delete</button>
                            Question<h4>`+question.question+`</h4>
                            Answer:
                            <hr></div>`).appendTo('.questions');
                    $('#ques-body').val('');
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

                 $('.questions' ).find('#'+response.answer.id).append( "Answer:<p class='event-body'>"+response.answer.answer+"</p><hr>" );


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
                $( " <div class='row'><div class='col-md-8' id='"+response.id+"'></div>" ).prependTo(".info-parent" );
                $('#'+response.id).append("<h4 class='event-body'>"+description+"</h4>")
                $('#'+response.id).append( "<p class='event-time'><span>Posted at</span> "+response.time.date+"</p>" );
                $('#'+response.id).append("<div class='col-4'><button class='deleteinfo btn btn-danger float-right' btn-id='"+response.id+"'>Delete</button></div></div>");
                $('#'+response.id).append("<hr>");
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
