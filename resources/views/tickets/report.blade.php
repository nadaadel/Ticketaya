@extends('layouts.app')
@section('content')
<h3> you want to report user : {{$ticket->user->name}} that have ticket : {{$ticket->name}}  </h3>
<br>
let your message :
<br>
<form  method="POST" action="/tickets/report" enctype="multipart/form-data" class="form-inline">
@csrf
<textarea name="msg"></textarea>

<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Send</button>
<input type="hidden" name="ticket_id" value="{{$ticket->id}}">
</form>

@endsection