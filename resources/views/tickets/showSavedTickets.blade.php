@extends('layouts.app')
@section('content')
<div class="container">
    <section>
        <div class="row">
                <div class="col-md-12 col-xs-12">
                   <h2 class="pt-4"> Your Favourite Tickets </h2>
                </div>
        </div>
    </section>
    <section>
        <div class="row">
                <div class="col-md-2">
                </div>
            <div class="col-md-8">
                <div class="row">
                        @foreach($tickets as $ticket)
                        <div class="col-md-4 col-xs-12 tick-search ticket-card-parent">
                            <div class="card ticket-card">
                                <div class="card-img"  style=" background-image: url({{ asset('storage/images/tickets/'. $ticket->photo) }});">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ucwords($ticket->name)}} <span class="ticket-price">{{$ticket->price}} L.E</span></h3>
                                    <p class="ticket-des">{{substr($ticket->description,0,70)}}</p>
                                    <div class="ticket-qty d-flex">
                                        <h4 class="">Available Quantity</h4>
                                        <div class="ticket-qty-num d-flex align-items-center"><span>{{$ticket->quantity}}</span></div>
                                    </div>
                                    <div class="ticket-btn text-center">
                                        <a href="/tickets/{{$ticket->id}}" class="btn btn-primary">Request This Ticket</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @endforeach

                </div>
            </div>
        </div>
        {{ $tickets->links() }}
    </section>
</div>
  @if(Auth::check())

  <script>
        $(document).on('click','.heart',callFunction);
        var click ={!! json_encode(Auth::user()->savedTickets->contains($ticket->id))!!} ;
         function callFunction() {
            var element=$(this);
           if (!click) {$.ajax({
             url: '/tickets/save/{{$ticket->id}}',
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            if(response.res == 'success'){
            element.parent().empty().append("<i  class='fas fa-heart heart'></i>");
            click = true;
            }
        }
         });
           } else {
            $.ajax({
             url: '/tickets/unsave/{{$ticket->id}}',
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            if(response.res == 'success'){
            element.parent().empty().append("<i class='far fa-heart heart'></i>");
             click = false;
            }
            }
         });

           }
         }
        </script>
         @endif
@endsection


