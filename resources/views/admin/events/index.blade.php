@extends('admin.index')
@section('content')
<div class="container">
  <div class="row">

  <h1>All Events </h1>


  <form method="POST" action="/events/search" enctype="multipart/form-data" class="form-inline">
    {{ csrf_field() }}
  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

  </form>
  <div class="col-sm">
      <a href={{ URL::to('events/create' )}} ><input type="button" class="btn btn-success" value='Create Event'/></div></a>
  <table class="table table-hover">
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
  @foreach($events as $event)
  <tr>
        <th scope="row">{{$event->id}}</th>
        <td>{{ucwords($event->name)}}</td>
        <td>{{$event->user->name}}</td>
        <td><img src="{{ asset('storage/images/events/'. $event->photo) }}" style="width:150px; height:150px;"></td>
        <td> {{$event->created_at->diffForHumans()}} </td>
        <td><a href={{ URL::to('events/' . $event->id ) }} type="button" class="btn btn-success" >View</a></td>
       @if((Auth::user() && Auth::user()->id == $event->user_id)||Auth::user()->hasRole('admin'))
       
        <td><a href={{ URL::to('events/edit/' . $event->id ) }} type="button" class="btn btn-primary" >Edit</a></td>
        <td>
        <form action="{{URL::to('events/delete/'. $event->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
            {!! csrf_field() !!}
            {{method_field('Delete')}}
        </form>
        </td>
      @endif
  </tr>
  @endforeach
  </tbody>
  </table>
  </div>
</div>
  </div>
@endsection


