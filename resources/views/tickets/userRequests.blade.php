@extends('layouts.app')

@section('content')


<h2> Requests Received</h2>

@foreach ($userRequestsReceived as  $ticket)

     @if($ticket->is_accepted == 0)

     {{ $ticket->requested_user()->name }} Request {{ $ticket->ticket()->name }} from You with quantity ={{$ticket->quantity}}

     <form method="POST" action="/users/contact/{{ $ticket->requester_id}}">
        @csrf
        <input type="submit" value="Contact">
    </form>

    <form  method="POST" action="/tickets/accept/{{$ticket->ticket_id}}/{{ $ticket->requester_id}}">
        @csrf
        <input type="submit" value="Accept">
    </form>


    <form  method="POST" action="/tickets/cancel/{{$ticket->ticket_id}}/{{ $ticket->requester_id}}">
        @csrf
        <input type="submit" value="cancel">
    </form>
    
    @endif

@endforeach

<h2>My Sold</h2>
@foreach ($userTicketsSold as  $sold)
    You Sold {{ $sold->ticket()->name }} To {{ $sold->buyer()->name }}
<br>

@endforeach


<h2> Wanted </h2>
@foreach ($userRequestsWanted as  $ticket)
 @if($ticket->is_accepted == 0 )
    You Request {{ $ticket->ticket()->name }} from {{ $ticket->ticket()->user->name }}
    and your ticket is pending

@endif

 @if($ticket->is_accepted == 1 && $ticket->is_sold == 0)
    You Request {{ $ticket->ticket()->name }} from {{ $ticket->ticket()->user->name }}
    and your ticket request Accepted

  <form method="POST" action="/tickets/sold/{{$ticket->ticket_id}}">
        @csrf
        <input type="submit" value="I received my ticket">
    </form>
    <form  method="get" action="/tickets/cancel/{{$ticket->ticket_id}}">
        @csrf
        <input type="submit" value="Cancel">
    </form>

    @endif
    <br>
@endforeach

<h2> Bought </h2>
@foreach ($userTicketsBought as  $ticket)
     @if($ticket->ticket()->is_sold == 1)
    You Bought {{ $ticket->ticket()->name }} from {{ $ticket->ticket()->user->name }}
    @endif
    <br>
@endforeach


<br>

@endsection
