@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row mt-3 mb-3">
                <div class="col-md-10 col-xs-12">
                   <div class="search-content  d-flex">
                       <form method="POST" action="/events/search" enctype="multipart/form-data" class="text-right">
                              {{ csrf_field() }}
                        <input class="search pgs-search" type="search" placeholder="Search for upcomming events or more..." aria-label="Search" name="search">
                        <button class="btn btn btn-secondary search-btn pgs-search-btn" type="submit">Search</button>
                       </form>
                       <a href={{ URL::to('events/create' )}} ><input type="button" class="btn btn-primary ml-5" value='Add New Event'/></a>
                   </div>
                </div>
        </div>
    <div class="row category-tabs events-tabs">
        <div class="col-md-2 col-sm-4 col-4 mb-2">
             <a href="#">
               <div class="catg-tab align-items-center d-flex tab-img-1">
                    <div class="overlay"></div>
                    <h3 class="m-auto">ALL EVENTS</h3>
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
        <div class="col-md-12  mt-3">
            <h2>All Events</h2>
        </div>
    </div>
    <div class="row  mt-5 mb-5">
        <div class="col-md-3 col-12 mb-3"><!--event card starts here-->
           <a href="#">
                <div class="event-card">
                    <div class="event-img" style="background-image: url(../images/home/1-silder.jpg);">
                        <a class="btn ctrl-btn like-btn"><i class="far fa-heart"></i></a>
                    </div>
                    <div class="event-content">
                        <h3>Summer party event</h3>
                        <p>There are many variations of passages of Lorem Ipsum available.</p>
                    </div>
                    <div class="follow text-center">
                        <a class="btn btn-primary" href="#">FOLLOW</a>
                    </div>
                </div>
            </a>
        </div><!--event card starts here-->
        
    </div>
    
  <div class="row">

  <h1>All Events </h1>


  <form method="get" action="/events/search" enctype="multipart/form-data" class="form-inline">
    {{ csrf_field() }}
  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

  </form>
  <div class="col-sm">
      <a href={{ URL::to('events/create' )}} ><input type="button" class="btn btn-success" value='Create Event'/></a>
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
  @foreach($events as $event)
  <tr>
        <th scope="row">{{$event->id}}</th>
        <td>{{ucwords($event->name)}}</td>
        <td>{{$event->user->name}}</td>
        <td><img src="{{ asset('storage/images/events/'. $event->photo) }}" style="width:150px; height:150px;"></td>
        <td> {{$event->created_at->diffForHumans()}} </td>
        <td><a href={{ URL::to('events/' . $event->id ) }} type="button" class="btn btn-success" >View</a></td>
       @if(Auth::user() && Auth::user()->id == $event->user_id)

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
  {{ $events->links() }}
  </div>
</div>
  </div>
@endsection


