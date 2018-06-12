@extends('layouts.app')
@section('content')
<div class="container">
 
  <div class="row mt-3 mb-3">
                <div class="col-md-10 col-xs-12">
                   <div class="search-content  d-flex">
                       <form method="POST" action="/tickets/search" enctype="multipart/form-data" class="text-right">
                              <input type="hidden" name="_token" value="02waM1D8GMMjJUL1Xa54YSLhlvmTdeJC5ZiLKeT7">
                        <input class="search pgs-search" type="search" placeholder="Search for new tickets or more..." aria-label="Search" name="search">
                        <button class="btn btn btn-secondary search-btn pgs-search-btn" type="submit">Search</button>
                       </form>
                       <a href=http://localhost:8000/tickets/create ><input type="button" class="btn btn-primary ml-5" value='Add New Ticket'/></a>
                   </div>
                </div>
        </div>
    <div class="row category-tabs ">
        <div class="col-md-2 col-sm-4 col-4 mb-2">
             <a href="#">
               <div class="catg-tab align-items-center d-flex tab-img-1">
                    <div class="overlay"></div>
                    <h3 class="m-auto">ALL TICKETS</h3>
               </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-4 mb-2">
          <a href="#">
               <div class=" catg-tab align-items-center d-flex tab-img-2">
                    <div class="overlay"></div>
                    <h3 class="m-auto">SPORTS</h3>
               </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-4 mb-2">
          <a href="#">
               <div class=" catg-tab align-items-center d-flex tab-img-3">
                    <div class="overlay"></div>
                    <h3 class="m-auto">MUSIC</h3>
               </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-4 mb-2">
          <a href="#">
               <div class=" catg-tab align-items-center d-flex  tab-img-4">
                    <div class="overlay"></div>
                    <h3 class="m-auto">FESTIVAL</h3>
               </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 col-4 mb-2">
          <a href="#">
               <div class=" catg-tab align-items-center d-flex tab-img-5">
                    <div class="overlay"></div>
                    <h3 class="m-auto">TRAVEL</h3>
               </div>
          </a>
        </div>
        <div class="col-md-2 col-sm-4 col-4 mb-2">
          <a href="#">
               <div class=" catg-tab align-items-center d-flex tab-img-6">
                    <div class="overlay"></div>
                    <h3 class="m-auto">FASHION</h3>
               </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <h2>All Tickets</h2>
        </div>
    </div>
    <div class="row justify-content-md-center mt-5 mb-5">
        <div class="col-md-10 col-sm-10 col-10 mb-3"> <!-- Ticked list card -->
            <div class="ticket-list">
                <div class="row">
                    <div class="col-md-3 col-sm-12 pl-0 pr-0">
                        <div class="ticket-img" style="background-image: url(../images/home/1-silder.jpg);"></div>
                    </div>
                    <div class="col-md-4 col-sm-12 pt-3 pb-3 ">
                        <h3>Summer Party Festival</h3>
                        <p>There are many variations of passages of Lorem Ipsum available.</p>
                        <div class="ticket-qty d-flex pt-2">
                            <h4 class="">Available Quantity</h4>
                            <div class="ticket-qty-num d-flex align-items-center"><span>20</span></div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 pt-3 pb-3 text-right">
                        <div class="ticket-price">
                            <h3 class="price">200 L.E</h3>
                        </div>
                        <div class="ticket-ctrl-btns pt-5">
                           <a class="btn ctrl-btn delete-btn"><i class="far fa-trash-alt"></i></a>
                            <a class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                            <a class="btn ctrl-btn like-btn"><i class="far fa-heart"></i></a>
                            <a class="btn btn-primary ml-3" href="#">REQUEST THIS TICKET</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of Ticked list card -->
        
    </div>

 
 
 
 
 
  <div class="row">

  <h1>All Tickets </h1>


  <form method="POST" action="/tickets/search" enctype="multipart/form-data" class="form-inline">
    {{ csrf_field() }}
  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

  </form>
  <div class="col-sm">
      <a href={{ URL::to('tickets/create' )}} ><input type="button" class="btn btn-success" value='Create Ticket'/></div></a>
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
        <td> {{ $ticket->created_at->diffForHumans() }} </td><td>
    <a href={{ URL::to('tickets/' . $ticket->id ) }} type="button" class="btn btn-success" >View</a></td>

@if(Auth::user()&&Auth::user()->id == $ticket->user_id)
        <td><a href={{ URL::to('tickets/edit/' . $ticket->id ) }} type="button" class="btn btn-warning" >Edit</a></td>
   <td>
     <form action="{{URL::to('tickets/' . $ticket->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
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


