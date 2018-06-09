@extends('admin.index')
@section('content')
<div class="container">
  <div class="row">
      <div class="col-sm">
        <form method="POST" action="/tickets/search" enctype="multipart/form-data" class="form-inline">
            {{ csrf_field() }}
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button></form>
      </div>
    </div>
      <div class="row">
      <div class="col-sm">
            <a href="{{URL::route('createticket')}}" ><input type="button" class="btn btn-success" value='Create Ticket'/></a>
  <table class="table table-hover table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Posted By</th>
        <th scope="col">Photo</th>
        <th scope="col">Created At</th>
        <th scope="col" colspan='3'>Actions</th>
      </tr>
    </thead>
    <tbody>
  @foreach($tickets as $ticket)
  <tr>
        <th scope="row">{{$ticket->id}}</th>
        <td>{{ucwords($ticket->name)}}</td>
        <td>{{$ticket->user->name}}</td>
        <td><img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style="width:150px; height:150px;"></td>
        <td> {{ $ticket->created_at->diffForHumans() }} </td>
<td>
    <a href={{ URL::to('tickets/' . $ticket->id ) }} type="button" class="btn btn-success" >View</a></td>
        <td><a href={{ URL::to('tickets/edit/' . $ticket->id ) }} type="button" class="btn btn-warning" >Edit</a></td>
   <td>
     <form action="{{URL::to('tickets/' . $ticket->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
      {!! csrf_field() !!}
      {{method_field('Delete')}}
    </form>
    </td>
  </tr>
  @endforeach
  </tbody>
  </table>
</div>
  </div>
  </div>
@endsection


