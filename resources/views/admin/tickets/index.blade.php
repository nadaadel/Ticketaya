@extends('admin.index')
@section('content')
<div class="container">
        <div class="row mt-3 mb-3">
                <div class="col-md-9 col-xs-12">
                   <div class="search-content d-flex">
                       <form method="get" action="/tickets/search" enctype="multipart/form-data" class="text-right">
                        {!! csrf_field() !!}
                        <input class="search pgs-search" type="search" placeholder="Search for new tickets or more..." aria-label="Search" name="search">
                        <button class="btn btn btn-secondary search-btn pgs-search-btn" type="submit">Search</button>
                       </form>
                   </div>
                </div>
        </div>
    <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{ URL::to('tickets/create' )}} " ><input type="button" class="btn btn-primary ml-5" value='Add New Ticket'/></a></div>
    </div>
    <div class="row">
  <table class="table table-hover ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Photo</th>
        <th scope="col">Posted By</th>
        <th scope="col">No of spams</th>
        <th scope="col">Created from</th>
        <th scope="col">Expired at </th>
        <th scope="col" colspan='2'>Actions</th>
      </tr>
    </thead>
    <tbody>
  @foreach($tickets as $ticket)

  <tr class="danger">


        <th scope="row">{{$ticket->id}}</th>
        <td><a href="{{ route('showticket', ['id' => $ticket->id]) }}">{{ucwords($ticket->name)}}</a></td>
        <td><img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style="width:160px; height:120px;"></td>
        <td><a href="{{ route('showuser', ['id' => $ticket->user->id]) }}">{{$ticket->user->name}}</a></td>
        <td>{{$ticket->spammers->count()}}</td>

        <td> {{ $ticket->created_at->diffForHumans() }} </td>
<td>{{ $ticket->expire_date}}</td>
        <td><a href={{ URL::to('tickets/edit/' . $ticket->id ) }} type="button" class="btn btn-warning" >Edit</a></td>
   <td><form action="{{URL::to('tickets/' . $ticket->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
      {!! csrf_field() !!}
      {{method_field('Delete')}}
    </form>
    </td>
  </tr>

  @endforeach
  </tbody>
  </table>
  {{ $tickets->links() }}
</div>
  </div>
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


