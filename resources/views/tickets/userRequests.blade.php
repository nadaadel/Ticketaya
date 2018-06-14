@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <h2>Your Tickets Requests</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="true">Requests Received</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="mysold-tab" data-toggle="tab" href="#mysold" role="tab" aria-controls="mysold" aria-selected="false">My Sold</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="wanted-tab" data-toggle="tab" href="#wanted" role="tab" aria-controls="wanted" aria-selected="false">Wanted</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="bought-tab" data-toggle="tab" href="#bought" role="tab" aria-controls="bought" aria-selected="false">Bought</a>
              </li>

            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="requests" role="tabpanel" aria-labelledby="requests-tab"><!--Requests tabs start here-->
                  <div class="row justify-content-md-center mt-4">
         @foreach ($userRequestsReceived as  $ticket)
            @if($ticket->is_accepted == 0)
                      <div class="col-md-10 col-12 requests mt-4"><!--REQUESTED TICKET CARD START HERE -->
                          <div class="row ticket-details ">
                              <div class="col-md-2 col-6 ticket-img" style="background-image: url({{ asset('storage/images/tickets/'. $ticket->ticket()->photo) }});"></div>
                              <div class="col-md-3 col-6  ticket-content d-flex align-items-center">
                                  <div class="content-inner">
                                      <h3>{{ $ticket->ticket()->name }}</h3>

                                      <p class="date">{{ $ticket->created_at->diffForhumans() }}</p>
                                  </div>
                              </div>
                              <div class="col-md-3 col-6  ticket-qty d-flex align-items-center">
                                    <h4 class="">Available Quantity</h4>
                                    <div class="ticket-qty-num d-flex align-items-center"><span>{{ $ticket->ticket()->quantity }}</span></div>
                              </div>
                              <div class="col-md-4 col-6 ticket-edit d-flex align-items-center">
                                  <a href="#" class="btn btn-light" >Edit Ticket </a>
                              </div>
                          </div>
                          <div class="row buyers-list">
                             <div class="col-md-12"><!--USER REQUEST START HERE -->
                                 <div class="row pt-2 pb-2">
                                     <div class="col-md-2 col-4 d-flex align-items-center">
                                         <div class="user-img" style="background-image: url({{ asset('storage/images/users/'. $ticket->requested_user()->avatar)}});"></div>
                                     </div>
                                     <div class="col-md-3 col-4 d-flex align-items-center">
                                         <h4> {{ $ticket->requested_user()->name }}</h4>
                                     </div>
                                     <div class="col-md-3 col-4  ticket-qty d-flex align-items-center">
                                            <h4 class="">Wanted Quantity</h4>
                                            <div class="ticket-qty-num d-flex align-items-center"><span>{{$ticket->quantity}}</span></div>
                                      </div>
                                      <div class="col-md-4 col-12 d-flex align-items-center">
                                          <div class="acceptance-btns">
                                              <a href="/users/contact/{{ $ticket->requester_id}}" class="btn btn-light" >Contact </a>
                                              <a href="/tickets/accept/{{$ticket->ticket_id}}/{{ $ticket->requester_id}}" class="btn btn-success" >Accept </a>
                                              <a href="/tickets/cancel/{{$ticket->ticket_id}}/{{ $ticket->requester_id}}" class="btn btn-danger" >Cancel </a>
                                          </div>
                                      </div>
                                 </div>
                             </div><!--END OF USER REQUEST  -->

                          </div>
                      </div><!-- END OF REQUESTED TICKET CARD  -->
            @endif
        @endforeach

                  </div>
              </div><!--End of Requests tabs-->
              <div class="tab-pane fade" id="mysold" role="tabpanel" aria-labelledby="mysold-tab"><!--My sold tabs start here-->
                  <div class="row justify-content-md-center mt-4">
             @foreach ($userTicketsSold as  $sold)
                      <div class="col-md-10 col-12 requests mt-4"><!--SOLD TICKET CARD START HERE -->
                          <div class="row ticket-details ">
                              <div class="col-md-2 col-6 ticket-img" style="background-image: url({{ asset('storage/images/tickets/'. $sold->ticket()->photo) }});"></div>
                              <div class="col-md-3 col-6  ticket-content d-flex align-items-center">
                                  <div class="content-inner">
                                      <h3>{{ $sold->ticket()->name }}</h3>

                                  <p class="date">{{ $sold->created_at->diffForhumans()}}</p>
                                  </div>
                              </div>
                              <div class="col-md-3 col-6  ticket-qty d-flex align-items-center">
                                    <h4 class="">Available Quantity</h4>
                              <div class="ticket-qty-num d-flex align-items-center"><span>{{$sold->ticket()->quantity}}</span></div>
                              </div>
                              <div class="col-md-4 col-6 ticket-edit d-flex align-items-center">
                                    <a href="{{ URL::to('tickets/edit/' . $sold->ticket()->id ) }}" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                                </div>
                          </div>
                          <div class="row buyers-list">
                             <div class="col-md-12"><!--USER SOLD START HERE -->
                                 <div class="row pt-2 pb-2">
                                     <div class="col-md-2 col-4 d-flex align-items-center">
                                         <div class="user-img" style="background-image: url({{ asset('storage/images/users/'.  $sold->buyer()->avatar)}});"></div>
                                     </div>
                                     <div class="col-md-3 col-4 d-flex align-items-center">
                                         <h4> {{ $sold->buyer()->name }}</h4>
                                     </div>
                                     <div class="col-md-3 col-4  ticket-qty d-flex align-items-center">
                                            <h4 class="">Sold Quantity</h4>
                                            <div class="ticket-qty-num d-flex align-items-center"><span>2</span></div>
                                      </div>
                                      <div class="col-md-4 col-12 d-flex align-items-center">
                                          <div class="acceptance-btns">
                                              <a href="#" class="btn btn-light" >Contact </a>
                                              <h3 class="text-danger pl-3 d-inline">SOLD</h3>
                                          </div>
                                      </div>
                                 </div>
                             </div><!--END OF USER SOLD  -->

                          </div>
                      </div><!-- END OF SOLD TICKET CARD  -->
            @endforeach

                  </div>
              </div><!--End of my sold-->
              <div class="tab-pane fade" id="wanted" role="tabpanel" aria-labelledby="wanted-tab"><!--Wanted tab Strat Here-->
                   <div class="row justify-content-md-center mt-4">
                @foreach ($userRequestsWanted as  $ticket)
                      <div class="col-md-10 col-12 requests mt-4"><!--WANTED CARD START HERE-->
                          <div class="row ticket-details ">
                              <div class="col-md-2 col-6 ticket-img" style="background-image: url({{ asset('storage/images/tickets/'.  $ticket->ticket()->photo)}});"></div>
                              <div class="col-md-4 col-6  ticket-content d-flex align-items-center">
                                  <div class="content-inner">
                                      <h3>{{ $ticket->ticket()->name }}</h3>

                                      <p class="date">{{ $ticket->created_at->diffForhumans() }}</p>
                                      <div class="d-flex">
                                          <h4 class="">Quantity I want</h4>
                                          <div class="ticket-qty-num d-flex align-items-center"><span>{{ $ticket->quantity }}</span></div>
                                      </div>
                                  </div>
                              </div>
                            @if($ticket->is_accepted == 0)
                            <div class="col-md-6 col-12 ticket-edit d-flex align-items-center">
                                 <h3 class="active-show"> Pending </h3>
                            </div>
                            @endif
                            @if($ticket->is_accepted == 1 && $ticket->is_sold == 0)
                              <div class="col-md-6 col-12 ticket-edit d-flex align-items-center">
                                  <div class="acceptance-btns">
                                        <a href="/tickets/sold/{{$ticket->ticket_id}}" class="btn btn-success" >I Recived My Ticket </a>
                                        <a href="/tickets/cancel/{{$ticket->ticket_id}}" class="btn btn-danger" >Cancel </a>
                                         <a href="{{ URL::to('tickets/' . $ticket->ticket_id ) }}" class="btn btn-light" >Show </a>
                                  </div>
                              </div>
                            @endif
                            </div>
                          </div><!--END OF WANTED CARD-->
                @endforeach
                      </div>
                  </div><!--End of Wanted-->
              <div class="tab-pane fade" id="bought" role="tabpanel" aria-labelledby="bought-tab"><!--  bought tab start here-->
                  <div class="row justify-content-md-center mt-4">
                @foreach ($userTicketsBought as  $bought)
                      <div class="col-md-10 col-12 requests mt-4"><!--BOUGHT CARD START HERE-->
                          <div class="row ticket-details ">
                              <div class="col-md-2 col-6 ticket-img" style="background-image: url({{ asset('storage/images/tickets/'. $bought->ticket()->photo) }});"></div>
                              <div class="col-md-6 col-6  ticket-content d-flex align-items-center">
                                  <div class="content-inner">
                                      <h3>{{ $bought->ticket()->name }}</h3>

                                      <p class="date">{{$bought->created_at}}</p>
                                      <P class="mb-0">You bought this ticket from {{ $bought->ticket()->user->name }}</P>
                                  </div>
                              </div>
                              <div class="col-md-4 col-12 ticket-edit d-flex align-items-center">
                                  <div class="acceptance-btns">

                                         <a href="#" class="btn btn-light" >Contact with Seller </a>
                                  </div>
                              </div>
                          </div>
                      </div><!--END OF BOUGHT CARD-->
                @endforeach
              </div>
            </div><!--  end of bought tab-->
        </div>
    </div>
</div>
@endsection
