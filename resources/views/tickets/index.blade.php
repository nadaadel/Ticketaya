@extends('layouts.app')
@section('content')
<div class="container">

  <div class="row mt-3 mb-3">
               <div class="col-md-10 col-xs-12">
                   <div class="search-content  d-flex">
                       <form method="get" action="/tickets/search" enctype="multipart/form-data" class="text-right">
                              {{ csrf_field() }}
                        <input class="search pgs-search" type="search" placeholder="Search for new tickets or more..." aria-label="Search" name="search">
                        <button class="btn btn btn-secondary search-btn pgs-search-btn" type="submit">Search</button>
                       </form>
                       <a href="{{ URL::to('tickets/create' )}} " ><input type="button" class="btn btn-primary ml-5" value='Add New Ticket'/></a>
                   </div>
                </div>
        </div>
    <div class="row category-tabs ">
        <div class="col-md-2 col-sm-4 col-4 mb-2">
        <a href="{{URL::route('alltickets')}}">
               <div class="catg-tab align-items-center d-flex tab-img-1">
                    <div class="overlay"></div>
                    <h3 class="m-auto">ALL TICKETS</h3>
               </div>
            </a>
        </div>
        @foreach($categories as $category)
        <div class="col-md-2 col-sm-4 col-4 mb-2">
        <a href="/tickets/filter/{{$category->id}}">
               <div class=" catg-tab align-items-center d-flex"  style="background-image: url({{ asset('storage/images/categories/'.$category->photo) }});">
                    <div class="overlay"></div>
                            <h3 class="m-auto">{{$category->name}}</h3>
               </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" >
            <h2>All Tickets</h2>
        </div>
    </div>
    <div class="row justify-content-md-center mt-5 mb-5">
    @if($tickets !== null)
    @foreach($tickets as $ticket)
        <div class="col-md-10 col-sm-10 col-10 mb-3"> <!-- Ticked list card -->
            <div class="ticket-list">
                <div class="row">
                    <div class="col-md-3 col-sm-12 pl-0 pr-0">
                        <div class="ticket-img" style="background-image: url({{ asset('storage/images/tickets/'. $ticket->photo)}});"></div>
                    </div>
                    <div class="col-md-4 col-sm-12 pt-3 pb-3 ">

                                <h3>{{ucwords($ticket->name)}}</h3>
                        <p>{{substr($ticket->description,0,150)}}.</p>
                        <div class="ticket-qty d-flex pt-2">
                            <h4 class="">Available Quantity</h4>
                            <div class="ticket-qty-num d-flex align-items-center"><span>{{$ticket->quantity}}</span></div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 pt-3 pb-3 text-right">
                        <div class="ticket-price">
                            <h3 class="price">{{$ticket->price}} L.E</h3>
                    </div>
                    <div class="ticket-ctrl-btns pt-5">
                    @if(Auth::user()&&Auth::user()->id == $ticket->user_id)
                        <a type="submit" class="btn ctrl-btn delete-btn"><i class="far fa-trash-alt"></i></a>
                        <form action="{{URL::to('tickets/' . $ticket->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
                            {!! csrf_field() !!}
                            {{method_field('Delete')}}
                        </form>
                        <a href="{{ URL::to('tickets/edit/' . $ticket->id ) }}" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                    @elseif(Auth::check())
                    <a class="btn ctrl-btn like-btn container" ticket-no={{$ticket->id}} >
                            @if(Auth::user()->savedTickets->contains($ticket->id))
                            <i class='fas fa-heart heart' clicked="1"></i>
                            @else
                            <i class='far fa-heart heart' clicked="0"></i>
                            @endif
                    </a>
                        <a class="btn btn-primary ml-3" href="{{ URL::to('tickets/' . $ticket->id ) }}">REQUEST THIS TICKET</a>
                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of Ticked list card -->
        @endforeach
        @endif

    </div>

  @if(Auth::check())

  <script>

        $(document).on('click','.heart',
        // var click ={!! json_encode(Auth::user()->savedTickets->contains($ticket->id))!!} ;
         function () {
            var element=$(this);
            var click =element.attr('clicked');
            var ticket_id=element.parent().attr('ticket-no');
           if (click != 1)
            {$.ajax({
             url: '/tickets/save/'+ticket_id,
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            if(response.res == 'success'){
            element.parent().empty().append("<i  class='fas fa-heart heart' clicked='1'></i>");
            click = true;
            }
        }
         });
           } else {
            $.ajax({
             url: '/tickets/unsave/'+ticket_id,
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            if(response.res == 'success'){
            element.parent().empty().append("<i class='far fa-heart heart' clicked='0'></i>");
             click = false;
            }
            }
         });

           }
         });
        </script>
         @endif
@endsection


