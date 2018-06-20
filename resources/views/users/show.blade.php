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
                                            @foreach(Auth::user()->tickets as $ticket)
                                            <div class="row ">
                                                <div class="col-md-3 col-sm-12 pl-0 pr-0">
                                                    <div class="ticket-img" style="background-image: url(http://localhost:8000/storage/images/tickets/{{$ticket->photo}});"></div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 pt-3 pb-3 ">

                                                            <h3>{{$ticket->name}}</h3>
                                                    <p>{{$ticket->description}}</p>
                                                    <div class="ticket-qty d-flex pt-2">
                                                        <h4 class="">Available Quantity</h4>
                                                        <div class="ticket-qty-num d-flex align-items-center"><span>{{$ticket->quantity}}</span></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-12 pt-3 pb-3 text-right">
                                                    <div class="ticket-price">
                                                        <h3 class="price">{{$ticket->price}}</h3>
                                                </div>
                                            <div class="ticket-ctrl-btns pt-5" ticket-no="{{$ticket->id}}">
                                                        <a  class="btn ctrl-btn  deletebtn"><i class="far fa-trash-alt"></i></a>
                                                        <a href="{{ URL::to('tickets/edit/' . $ticket->id ) }}" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                                                    <a class="btn btn-primary ml-3" href="{{ route('showticket', ['id' => $ticket->id]) }}">View</a>
                                                                        </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div><!-- end of Ticked list card -->


                          </div>
                      </div>
                      <div class="tab-pane fade" id="myevents" role="tabpanel" aria-labelledby="myevents-tab">
                          <div class="row mt-4">

                                @foreach(Auth::user()->events as $event)

                                <div class="col-md-4 col-12 mb-4"><!--event card starts here-->
                                   <a href="{{ URL::to('events/' . $event->id ) }}" class="event-card-click">
                                        <div class="event-card">
                                            <div href="{{ URL::to('events/' . $event->id ) }}" class="event-img" style="background-image: url({{ asset('storage/images/events/'. $event->photo) }});">
                                            </div>
                                            <div class="event-content">
                                                <h3>{{ucwords($event->name)}}</h3>
                                                <p>{{substr($event->description,0,150)}}.</p>
                                            </div>
                                            <div class="follow text-center">
                                                <a  event-id="{{$event->id}}" class="btn ctrl-btn  deletebtn"><i class="far fa-trash-alt"></i></a>
                                                <a href="{{ URL::to('events/edit/' . $event->id ) }}" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                                            </div>
                                        </div>
                                   </a>
                                </div><!--event card starts here-->
                        @endforeach
                          </div>
                      </div>
                      <div class="tab-pane fade" id="eventsub" role="tabpanel" aria-labelledby="eventsub-tab">
                          <div class="row mt-4">
                              @if(!Auth::user()->favouriteEvents->isEmpty())
                              @foreach(Auth::user()->favouriteEvents as $event)
                              <div class="col-md-4 col-12 mb-4"><!--event card starts here-->
                                <a href="{{ URL::to('events/' . $event->id ) }}" class="event-card-click">
                                    <div class="event-card">
                                        <div href="{{ URL::to('events/' . $event->id ) }}" class="event-img" style="background-image: url({{ asset('storage/images/events/'. $event->photo) }});">
                                        </div>
                                        <div class="event-content">
                                            <h3>{{ucwords($event->name)}}</h3>
                                            <p>{{substr($event->description,0,150)}}.</p>
                                        </div>
                                    </div>
                               </a>
                            </div><!--event card starts here-->
                            @endforeach
                            @endif
                          </div>
                      </div>
                    </div>
            </div>
        </div>
    </div>
    <br/>
</section>

<script>
         $(document).on('click','.deletebtn',function(){
                        var ticket_id=$(this).closest('div').attr('ticket-no');
                        var url="{{ URL::route('alltickets') }}"
                        var resp = confirm("Do you really want to delete this ticket?");
                        if (resp == true) {
                            $.ajax({
                                type: 'POST',
                                url: '/tickets/'+ticket_id ,
                                data:{
                                '_token':'{{csrf_token()}}',
                                '_method':'DELETE',
                                },
                                success: function (response) {
                                    if(response.res=='success'){
                                    $('#'+ticket_id).remove();
                                    window.location=url
                                    }
                                    else{
                                        alert('failed')
                                    }
                                }
                            });

                        }
                       });
        </script>
@endsection
