@extends('admin.index')
@section('content')

     {{ $event-> name}} EVENT <br>
   
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
