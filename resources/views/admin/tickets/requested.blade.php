@extends('admin.index')
@section('content')
<div class="container">
        <div class="row mt-3 mb-3">
                <div class="col-md-9 col-xs-12">
                   <div class="search-content d-flex">
                       <form method="get" action="/tickets/search" enctype="multipart/form-data" class="text-right">
                        {!! csrf_field() !!}
                        <input class="search pgs-search" type="search" placeholder="Search for new tickets or more..." aria-label="Search" name="search">
                        <button class="btn btn btn-secondary search-btn pgs-search-btn" type="submit">Search</button>
                       </form>
                   </div>
                </div>
        </div>
    <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{ URL::to('tickets/create' )}} " ><input type="button" class="btn btn-primary ml-5" value='Add New Ticket'/></a></div>
    </div>
    <div class="row">
  <table class="table table-hover ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Photo</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        <th scope="col">Requester</th>
        <th scope="col">Expired at </th>
        <th scope="col" colspan='2'>Actions</th>
      </tr>
    </thead>
    <tbody>
  @foreach($requestedTickets as $requested)

  <tr class="danger">

        <th scope="row">{{$requested->ticket_id}}</th>
        <td><a href="{{ route('showticket', ['id' => $requested->ticket_id]) }}">{{ucwords($requested->ticket()->name)}}</a></td>
        <td><img src="{{ asset('storage/images/tickets/'. $requested->ticket()->photo) }}" style="width:160px; height:120px;"></td>

        <td>
            <a href="">{{$requested->ticket()->category->name}}</a></td>
        <td><a href="{{ route('showuser', ['id' => $requested->user_id]) }}">{{$requested->ticket()->user->name}}</a></td>
        <td><a href="{{ route('showuser', ['id' => $requested->requester_id]) }}">{{$requested->requested_user()->name}}</a></td>

        <td>{{ $requested->ticket()->expire_date}}</td>

     <td><a href={{ URL::to('tickets/' . $requested->ticket_id ) }} class="btn btn-warning" >View Ticket</a></td>
  </tr>

  @endforeach
  </tbody>
  </table>
  {{$requestedTickets->links() }}
</div>
  </div>
  </div>
@endsection


