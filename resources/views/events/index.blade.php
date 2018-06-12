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

@foreach($events as $event)
        <div class="col-md-4 col-12 mb-4"><!--event card starts here-->
           <a href="{{ URL::to('events/' . $event->id ) }}">
                <div class="event-card">
                    <div href="{{ URL::to('events/' . $event->id ) }}" class="event-img" style="background-image: url({{ asset('storage/images/events/'. $event->photo) }});">
                    </div>
                    <div class="event-content">
                        <a href="{{ URL::to('events/' . $event->id ) }}"><h3>{{ucwords($event->name)}}</h3></a>
                        <p>{{substr($event->description,0,150)}}.</p>
                    </div>
                    <div class="follow text-center">
                        @if(Auth::user() && Auth::user()->id == $event->user_id)
                        <a class="btn btn-primary" href="{{ URL::to('events/' . $event->id ) }}">View</a>
                        <a type="submit" class="btn ctrl-btn delete-btn"><i class="far fa-trash-alt"></i></a>
                        <a href="{{ URL::to('events/edit/' . $event->id ) }}" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                        @else
                        <a class="btn btn-primary" href="{{ URL::to('events/' . $event->id ) }}">JOIN</a>

                        @endif
                    </div>
                </div>
            </a>
        </div><!--event card starts here-->
@endforeach
    </div>
<div class="text-center">
{{ $events->links() }}
</div>

        <form action="{{URL::to('events/delete/'. $event->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
            {!! csrf_field() !!}
            {{method_field('Delete')}}
        </form>

@endsection


