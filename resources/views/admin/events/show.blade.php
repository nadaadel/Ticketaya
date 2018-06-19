@extends('admin.index')
@section('content')

    <section id="event-view">
       <div class="contaner-fluid"  style="background-image: url(../images/home/2-silder.jpg);">
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
                               <p class="gray">{{ $event->user->city->name }} </p>
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
                              <textarea class="info-body" cols="9"> </textarea>
                               <button id="info-submit" class="btn btn-info">Post</button>
                            </div>
                             @endif

                            <div class="info-parent">

                             @foreach ($eventInfos as $info )
                             <div class="event-info" id="{{$info->id}}"style="display:block;">
                             <p class="event-body">{{$info->body}} </p>
                             <p class="event-time">{{$info->created_at->diffForHumans()}} </p>
                            @if(Auth::user() && Auth::user()->id == $event->user_id)
                             <button class='deleteinfo' btn-id ="{{$info->id}}">delete</button>
                            @endif

                             <div>
                             <hr>
                             @endforeach

                            </div>
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


  <hr>
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
 <input type="hidden" id="event_id" value="{{$event->id}}">
@endsection
