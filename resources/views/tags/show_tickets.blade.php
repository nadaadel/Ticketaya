<div class="container">
        <div class="row">
      <h1>
     All Tickets related to {{$tag->name}}
      </h1>
      <div class="col-sm">
      <table class="table table-hover table-dark">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Posted By</th>
            <th scope="col">Photo</th>
            <th scope="col">Created At</th>
            <th scope="col" >Actions</th>
          </tr>
        </thead>
        <tbody>

      @foreach($tickets as $ticket)
      <tr>
            <th scope="row">{{$ticket->id}}</th>
            <td>{{$ticket->name}}</td>
            <td>{{$ticket->user->name}}</td>
            <td><img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style="width:150px; height:150px;"></td>
            <td> {{ $ticket->created_at }} </td>
            <td><a href={{ URL::to('tickets/' . $ticket->id ) }} type="button" class="btn btn-success" >View</a></td>
      @endforeach
      </tbody>
      </table>
      </div>
    </div>
      </div>

