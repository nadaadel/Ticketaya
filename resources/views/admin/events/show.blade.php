@extends('admin.index')
@section('content')

     {{ $event->name}} EVENT <br>
     <fieldset>
            <legend style="background-color: gray">Event Info </legend>
            <img src="{{ asset('storage/images/events/'. $event->photo) }}" style="width:150px; height:150px;">
            <p>Name : {{ $event->name }}</p>
            <p>Quantity:{{ $event->avaliabletickets }}</p>
            <p>Description:{{ $event->description }}</p>
            <p>Start Date :{{ $event->startdate }}</p>
            <p>End Date :{{ $event->enddate }}</p>
            <p>Category :{{ $event->category->name }}</p>
            <p>Location:{{ $event->region->name }},{{ $event->city->name }}</p>
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
  <hr>
  {{-- questions and answer --}}
  @if($questions)
  @foreach($questions as $question)
  <div qid="{{$question->id}}">
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
@endsection
