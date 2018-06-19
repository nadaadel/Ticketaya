@extends('layouts.app')


@section('content')
<section>

<!-- main header in home page -->
        <section id="hero-home">
            <div class='slider'>
                <div class="overlay"></div>
                <div class='slide1'></div>
                <div class='slide2'></div>
                <div class='slide3'></div>
                <div class="content d-flex align-items-center">
                    <div class="container ">
                        <div class="row auto">
                          <div class="col-md-6 offset-md-3 text-center">
                            <h1>Tickets to Anywhere <br>
                                Here you will Find It</h1>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                   suffered alteration in some form, by injected humour,
                                   or randomised words which don't look even slightly believable.</p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 offset-md-3 text-center">
                          <form method="GET" action="/tickets/search" enctype="multipart/form-data">
                              {{ csrf_field() }}
                            <input class="search" type="search" placeholder="Search Tickets, events or more..." aria-label="Search" name="search">
                            <button class="btn btn btn-primary search-btn" type="submit">Search</button>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="container">
                  <div class="row">


                  </div>
              </div>

        </section>
        <section>
<!--

                   {{-- HOT TICKETS --}}
        {{-- @if($hotTickets !== null)
            <div class="row">
            <h3 class="text-center">Hot Tickests</h3>
             @foreach ($hotTickets as $ticket)
             <div class="col-md-4 col-xs-12 tick-search ticket-card-parent">
                    <div class="card ticket-card">
                        <div class="card-img"  style=" background-image: url({{ asset('storage/images/tickets/'. $ticket->photo) }});">

                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{$ticket->name}} <span class="ticket-price">{{$ticket->price}} L.E</span></h3>
                            <p class="ticket-des">{{substr($ticket->description,0,70)}}</p>
                            <div class="ticket-qty d-flex">
                                <h4 class="">Available Quantity</h4>
                                <div class="ticket-qty-num d-flex align-items-center"><span>{{$ticket->quantity}}</span></div>
                            </div>
                            <div class="ticket-btn text-center">
                                <a href="/tickets/{{$ticket->id}}"  class="btn btn-primary">Request This Ticket</a>
                            </div>

                        </div>
                    </div>
                </div>
             @endforeach
            </div>
       @endif --}}
            
                                  {{-- HOT EVENTS --}}
{{--
            @if($hotEvents !== null)
            <div class="row">
                    <h3 class="text-center">Hot Events</h3>
                     @foreach ($hotEvents as $event)
                     <div class="col-md-4 col-xs-12 tick-search ticket-card-parent">
                            <div class="card ticket-card">
                                <div class="card-img"  style=" background-image: url({{ asset('storage/images/events/'. $event->photo) }});">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{$event->name}}</h3>
                                    <p class="ticket-des">{{substr($event->description,0,70)}}</p>
                                    <div class="ticket-qty d-flex">
                                        <h4 class="">Available Quantity</h4>
                                        <div class="ticket-qty-num d-flex align-items-center"><span>{{$event->avaliabletickets}}</span></div>
                                    </div>
                                    <div class="ticket-btn text-center">
                                        <a href="/events/{{$event->id}}"  class="btn btn-primary">Show Event</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                     @endforeach
                    </div>
                @endif --}}
        </section>
-->




            <!-- End of header in home page -->
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->


        <!-- <div class="row justify-content-center">
        @role('admin')
        <a href="/admin"  type="button" class="btn btn-default" >Admin Panel</a>
         @endrole
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>

                </div>
            </div>
        </div> -->
  </section>
@endsection
