@extends('layouts.app')
      @section('content')
      <div class="container">
          <section id="search-page">
              <div class="row">
                      <div class="col-md-12 col-xs-12">
                         <div class="search-content">
                             <form method="get" action="/tickets/search" enctype="multipart/form-data" class="text-center">
                                    {{ csrf_field() }}
                              <input class="search pgs-search" type="search" placeholder="Search Tickets, events or more..." aria-label="Search" name="search">
                              <button class="btn btn btn-secondary search-btn pgs-search-btn" type="submit">Search</button>
                             </form>
                         </div>
                      </div>
              </div>
          </section>
          <section>
                <div class="row">
                        <h2>
                                All Tickets related to {{$tag->name}}
                        </h2>
                  </div>
              <div class="row">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-8">
                      <div class="row">
                              @foreach($tickets as $ticket)

                              <div class="col-md-4 col-xs-12 tick-search ticket-card-parent">
                                  <div class="card ticket-card">
                                      <div class="card-img"  style=" background-image: url({{ asset('storage/images/tickets/'. $ticket->photo) }});">
                                          <div class="price-overlay">
                                              <h4 class="ticket-price">{{$ticket->price}} L.E</h4>
                                          </div>

                                      </div>

                                      <div class="card-body">
                                          <h4 class="card-title">{{ucwords($ticket->name)}}</h4>

                                          <p class="ticket-des">{{substr($ticket->description,0,70)}}</p>
                                          <div class="ticket-qty d-flex">
                                              <h5 class="">Available Quantity</h5>
                                              <div class="ticket-qty-num d-flex align-items-center"><span>{{$ticket->quantity}}</span></div>
                                          </div>
                                          <div class="ticket-btn text-center">
                                              <a href="/tickets/{{$ticket->id}}"  class="btn btn-primary mt-3">
                                                @if(Auth::check() && Auth::id() != $ticket->user_id)
                                                Request this Ticket
                                                @else
                                                Show Ticket
                                                @endif

                                            </a>
                                          </div>

                                      </div>
                                  </div>
                              </div>

                              @endforeach

                      </div>
                  </div>
                  {{ $tickets->links() }}
              </div>
          </section>
      </div>
      @endsection
