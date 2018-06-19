@extends('layouts.app')
@section('content')

<section class="user-profile">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3 col-12 text-center">
                <div class="user-profile-img">
                     <div style="background-image: url(../images/icons/avatar.jpg);">
                      @if($user->avatar)
                       <img src="{{ asset('storage/images/users/'. $user->avatar) }}">
                      @endif
<!--                    <div style="background-image: url(../images/icons/avatar.jpg);"></div>-->
                    </div>
                </div>
                <div class="user-info mt-4">
                    <h3>{{$user->name}}</h3>

                    <table>
                        <tr>
                            <td><span class="bold">Email </span></td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td><span class="bold">Phone </span></td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                           @if($user->city)
                            <td><span class="bold">City </span></td>
                            <td> {{$user->city->name}}</td>
                            @endif
                        </tr>
                        <tr>
                           @if($user->region)
                            <td><span class="bold">Region </span></td>
                            <td>{{$user->region->name}}</td>
                             @endif
                        </tr>

                    </table>
                </div>
                @if(Auth::check()&&Auth::user()->id==$user->id)
                <div class="mt-4">

                    <a href="{{ URL::to('users/edit/' . $user->id ) }}" class="btn btn-secondary"> Edit Profile</a>
                </div>
                @endif
            </div>
            <div class="col-md-9 col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="mytickets-tab" data-toggle="tab" href="#mytickets" role="tab" aria-controls="mytickets" aria-selected="true">My Tickets</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="myevents-tab" data-toggle="tab" href="#myevents" role="tab" aria-controls="myevents" aria-selected="false">My Events</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="eventsub-tab" data-toggle="tab" href="#eventsub" role="tab" aria-controls="eventsub" aria-selected="false">Subscribed Events</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="mytickets" role="tabpanel" aria-labelledby="mytickets-tab">
                          <div class="row justify-content-center mt-4">
                              
                                  <div class="col-md-10 col-sm-10 col-10 mb-3" id=""> <!-- Ticked list card -->
                                        <div class="ticket-list">
                                            <div class="row ">
                                                <div class="col-md-3 col-sm-12 pl-0 pr-0">
                                                    <div class="ticket-img" style="background-image: url(http://localhost:8000/storage/images/tickets/default.jpg);"></div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 pt-3 pb-3 ">

                                                            <h3>Hamaki Concert Ticket</h3>
                                                    <p>i want to sell this tickets.</p>
                                                    <div class="ticket-qty d-flex pt-2">
                                                        <h4 class="">Available Quantity</h4>
                                                        <div class="ticket-qty-num d-flex align-items-center"><span>6</span></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-12 pt-3 pb-3 text-right">
                                                    <div class="ticket-price">
                                                        <h3 class="price">500 L.E</h3>
                                                </div>
                                                <div class="ticket-ctrl-btns pt-5" ticket-no="">
                                                <a  class="btn ctrl-btn  deletebtn"><i class="far fa-trash-alt"></i></a>
                                                <a href="" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                                                    <a class="btn btn-primary ml-3" href="">View</a>
                                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end of Ticked list card -->

                              
                          </div>
                      </div>
                      <div class="tab-pane fade" id="myevents" role="tabpanel" aria-labelledby="myevents-tab">
                          <div class="row mt-4">
                              <div class="col-md-4 col-12 mb-4"><!--event card starts here-->
                               
                                    <div class="event-card">
                                        <div href="http://localhost:8000/events/1" class="event-img" style="background-image: url(http://localhost:8000/storage/images/events/photo);">
                                        </div>
                                        <div class="event-content">
                                            <h3>Tamer Hosny Concert</h3>
                                            <p>SUPER STAR KARIM MOHSEN.</p>
                                        </div>
                                        <div class="follow text-center">
                                            <a  class="btn ctrl-btn  deletebtn"><i class="far fa-trash-alt"></i></a>
                                            <a href="" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-primary ml-3" href="">View</a>
                                        </div>
                                    </div>
                              
                            </div><!--event card starts here-->
                          </div>
                      </div>
                      <div class="tab-pane fade" id="eventsub" role="tabpanel" aria-labelledby="eventsub-tab">
                          <div class="row mt-4">
                              <div class="col-md-4 col-12 mb-4"><!--event card starts here-->
                               <a href="http://localhost:8000/events/1" class="event-card-click">
                                    <div class="event-card">
                                        <div href="http://localhost:8000/events/1" class="event-img" style="background-image: url(http://localhost:8000/storage/images/events/photo);">
                                        </div>
                                        <div class="event-content">
                                            <h3>Tamer Hosny Concert</h3>
                                            <p>SUPER STAR KARIM MOHSEN.</p>
                                        </div>
                                        <div class="follow text-center">
                                                                </div>
                                    </div>
                               </a>
                            </div><!--event card starts here-->
                          </div>
                      </div>
                    </div>
            </div>
        </div>
    </div>
    <br/>
</section>
@endsection
