  <form method="POST" action="/tickets/request/{{$ticket->id}}">

<h4>{{ $ticket->name }}</h4>
    @csrf
  <input type="number" name="quantity" placeholder="Quantitiy">
  <input type="submit" value="i want this ticket">
</form>
