@extends('admin.index')
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
            <p>Location:{{ $event->region->name }},{{ $event->city->name }}</p>
            <p>Created by :{{ $event->user->name }} </p>
           <hr>
        </fieldset>


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
    Answer <div class="answer"  >{{$question->answer}} </div>
     </div>

      <hr>

    @endforeach
   @endif





@endsection
