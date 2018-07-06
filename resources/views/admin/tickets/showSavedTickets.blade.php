@extends('admin.index')
@section('content')
<div class="container">
    <div class="row">
            @if($tickets != null)
  <table class="table table-hover ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Photo</th>
        <th scope="col">Category</th>
        <th scope="col">Posted By</th>
        <th scope="col">No of spams</th>
        <th scope="col">Created from</th>
        <th scope="col">Expired at </th>
        <th scope="col" >Action</th>
      </tr>
    </thead>
    <tbody>
  @foreach($tickets as $ticket)

  <tr class="danger" ticket-no='1'>


        <th scope="row">{{$ticket->id}}</th>
        <td><a href="{{ route('showticket', ['id' => $ticket->id]) }}">{{ucwords($ticket->name)}}</a></td>
        <td><img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style="width:160px; height:120px;"></td>
        <td>
                {{-- {{ route('showticketsbycategory', ['id' => $ticket->category->id]) }} --}}
            <a href="">{{$ticket->category->name}}</a></td>
        <td><a href="{{ route('showuser', ['id' => $ticket->user->id]) }}">{{$ticket->user->name}}</a></td>
        <td>{{$ticket->spammers->count()}}</td>

        <td> {{ $ticket->created_at->diffForHumans() }} </td>
        <td>{{ $ticket->expire_date}}</td>
        <td>
        <a class="btn" ticket-no={{$ticket->id}}>
                        @if(Auth::user()->savedTickets->contains($ticket->id))
                        <span class='heart' clicked='1'>unsave</span>
                        @else
                        <span class='heart' clicked='0'>save</span>
                        @endif
                    </a>
        </td>
  </tr>

  @endforeach
  </tbody>
  </table>
  @else
  <h3>You didn't Favourite any Ticket yet !</h3>
  @endif
  {{ $tickets->links() }}
</div>
  </div>
  </div>
  @if(Auth::check())

  <script>

        $(document).on('click','.heart',
         function () {
            var element=$(this);
            var click =element.attr('clicked');
            var ticket_id=element.parent().attr('ticket-no');
            var ticket_row=element.closest('tr');
           if (click != 1)
            {$.ajax({
             url: '/tickets/save/'+ticket_id,
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            if(response.res == 'success'){
                element.parent().empty().append("<span class='heart' clicked='1'>unsave</span>");
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
                ticket_row.remove();
             click = false;

            }
            }
         });

           }
         });
        </script>
         @endif
@endsection



