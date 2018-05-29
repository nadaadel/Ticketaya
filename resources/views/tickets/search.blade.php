<table class="table table-hover table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Posted By</th>
        <th scope="col">Photo</th>
        <th scope="col">Created At</th>
        <th scope="col">Avaliable Tickets</th>
        <th scope="col">Expired Date</th>
        <th scope="col">Category</th>
        <th scope="col">Location</th>
        
      </tr>
    </thead>
    <tbody>

  @foreach($tickets as $ticket)
  <tr>
        <th scope="row">{{$ticket->id}}</th>
        <td>{{$ticket->name}}</td>
        <td>{{$ticket->user->name}}</td>
        <td><img src="" style="width:150px; height:150px;"></td>
        <td> {{ $ticket->created_at }} </td>
        <td> {{$ticket->quantity}} </td>
        <td> {{$ticket->expire_date}} </td>
        <td>{{$ticket->category->name}}</td>
                   
         <td>{{ $ticket->region }},{{ $ticket->city }}</td>
        
   
    
  </tr>
  @endforeach
  </tbody>
  </table>