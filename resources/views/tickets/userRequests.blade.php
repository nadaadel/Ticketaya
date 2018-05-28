<h2> Requests Received</h2>
@foreach ($userRequestsReceived as  $ticket)

     @if($ticket->pivot->is_accepted == 0)

     {{ $ticket->pivot->requester_id }} Request {{ $ticket->name }} from You

     <form method="POST" action="/users/contact/{{ $ticket->pivot->requester_id}}">
        @csrf
        <input type="submit" value="Contact">
    </form>

    <form  method="POST" action="/tickets/accept/{{$ticket->id}}/{{ $ticket->pivot->requester_id}}">
        @csrf
        <input type="submit" value="Accept">
    </form>


    <form  method="POST" action="/tickets/cancel/{{$ticket->id}}/{{ $ticket->pivot->requester_id}}">
        @csrf
        <input type="submit" value="cancel">
    </form>
     @else
      You Accept  {{ $ticket->pivot->requester_id }} Request for Ticket {{ $ticket->name }}
    @endif

@endforeach



<h2>My Sold</h2>
@foreach ($userTicketsSold as  $sold)
    You Sold {{ $sold->name }} To {{ $sold->pivot->buyer_id }}
<br>

@endforeach


<br>
