

@foreach ($userSpam as $spam )
     @if($spam->user_id == 1)
     {{-- @if($spam->user_id == Auth::user()->id ) --}}

      You Spamed This Ticket
      @else
      <form method="POST" action="/tickets/spam/{{$ticket->id}}">
        @csrf
      <input type="submit" value="spam">
    </form>
     @endif
@endforeach

  <form method="POST" action="/tickets/request/{{$ticket->id}}">

<h4>{{ $ticket->name }}</h4>
    @csrf
  <input type="number" name="quantity" placeholder="Quantitiy">
  <input type="submit" value="i want this ticket">
</form>
