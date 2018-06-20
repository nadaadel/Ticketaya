@extends('admin.index')
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
                            <p>We are an intermediate between seller and you to help you find your request and get all operation more easier to get your satisfy.

                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container posts">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12 mt-5 mb-3">

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



                                            @else
                                            <div class="text-center">
                                                <h3 class="mt-5 mb-5">
                                                    No Posts Created by event Organizers
                                                </h3>
                                            </div>
                                            @endif


                            <div class="pagenation">
                             {{ $eventInfos->links() }}
                            </div>



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
                                              <div my-name='answer'>Answer:{{$question->answer}}</div>
                                              @if(Auth::user() && Auth::user()->id == $event->user_id || Auth::user()->hasRole('admin'))
                                                  @if($question->answer != null)
                                                  <div class="answer-area" >
                                                        <textarea class="ans-body form-control txt-area" id={{$question->id}} placeholder=" Add Answer  ..." >{{$question->answer}}</textarea>
                                                        <button class="answer-submit btn btn-info mt-2" question-id="{{$question->id}}" question="{{$question->question}}" questioner="{{$question->user_id}}" >Edit Answer</button>
                                                    </div>
                                                  @else
                                                    <div class="answer-area" >
                                                        <textarea class="ans-body form-control txt-area" id={{$question->id}} placeholder=" Add Answer  ..." ></textarea>
                                                        <button class="answer-submit btn btn-info mt-2" question-id="{{$question->id}}" question="{{$question->question}}" questioner="{{$question->user_id}}" >Answer</button>
                                                        <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                                                       <input type="hidden" id="event_id" value="{{$event->id}}">

                                                    </div>
                                                  @endif
                                              @endif
                                    <hr>
                                </div>
                                @endforeach

                                @endif
                            </div>

                        </div>
                        <div class="pagenation">
                                {{ $questions->links() }}
                     </div>
                      </div><!-- end of questions tab-->

                    </div>
                </div>
            </div>
        </div>


     </section>
     <input type="hidden" id="event_id" value="{{$event->id}}">

@endsection
