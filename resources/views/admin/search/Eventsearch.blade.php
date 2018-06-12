@extends('admin.index')
@section('content')
<div class="container">
    <section id="search-page">
        <div class="row">
                <div class="col-md-12 col-xs-12">
                   <div class="search-content">
                       <form method="get" action="/events/search" enctype="multipart/form-data" class="text-center">
                              {{ csrf_field() }}
                        <input class="search pgs-search" type="search" placeholder="Search Tickets, events or more..." aria-label="Search" name="search">
                        <button class="btn btn btn-outline-primary search-btn pgs-search-btn" type="submit">Search</button>
                       </form>
                   </div>
                </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-3">
              <form method="GET" action="/events/filter">
                  <div class="list-group panel">
                    <a class="list-group-item list-group-item strong text-center" style="background: #009ce0; color: white;" data-toggle="collapse"> Personalize Your Search</a>
                    <a href="#demo2" class="list-group-item list-group-item strong" style="background: #f7f7f7;" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-book"></i> Category <i class="fa fa-caret-down"></i></a>
                    <div class="collapse list-group-submenu" id="demo2">
                      <ul class="p-0 mb-0" >
                          @foreach($categories as $category)
                      <li class="list-group-item"><input type="checkbox" name="category[]" value="{{$category->name}}"> {{$category->name}}</li>
                      @endforeach
                    </ul>
                    </div>
                    <a href="#demo5" class="list-group-item list-group-item strong" style="background: #f7f7f7;" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-cubes"></i>  Location <i class="fa fa-caret-down"></i></a>
                    <div class="collapse list-group-submenu" id="demo5">
                      <ul class="p-0 mb-0">
                            @foreach($cities as $city)
                            <li class="list-group-item"><input type="checkbox" name="city[]" value="{{$city->name}}"> {{$city->name}}</li>
                            @endforeach
                        </ul>
                    </div>

                      <input type="submit" class="list-group-item list-group-item strong text-center" value="Apply">
                  </div>
              </form>
            </div> <!-- filter  -->
            <div class="col-md-9">
                <div class="row">

                        @foreach($events as $event)

                        <div class="col-md-4 col-xs-12 tick-search event-card-parent">
                            <div class="card event-card">
                                <div class="card-img"  style=" background-image: url({{ asset('storage/images/events/'. $event->photo) }});">

                                </div>

                                <div class="card-body">
                                    <h3 class="card-title">{{$event->name}}</h3>
                                    <p class="event-des">{{substr($event->description,0,70)}}</p>
                                    <div class="event-qty d-flex">
                                        <h4 class="">Available Quantity</h4>
                                        <div class="event-qty-num d-flex align-items-center"><span>{{$event->avaliabletickets}}</span></div>
                                    </div>
                                    <div class="event-btn text-center">
                                        <a type="button" href="/events/{{$event->id}}" type="button" class="btn btn-primary">View This Event</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @endforeach

                </div>
            </div>
            {{ $events->links() }}
        </div>
    </section>
</div>
@endsection
