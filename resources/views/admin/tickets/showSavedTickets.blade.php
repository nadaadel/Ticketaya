@extends('admin.index')
@section('content')
<div class="container">
    <div class="row">
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

  <tr class="danger">


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
                <a class="btn">
                        @if(Auth::user()->savedTickets->contains($ticket->id))
                        <span class='heart'>unsave</span>
                        @else
                        <span class='heart'>save</span>
                        @endif
                    </a>
        </td>
  </tr>

  @endforeach
  </tbody>
  </table>
  {{ $tickets->links() }}
</div>
  </div>
  </div>
  @if(Auth::check() && Auth::user()->hasRole('admin'))
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
            element.parent().empty().append("<span class='heart'>unsave</span>");
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
            element.parent().empty().append("<span class='heart'>save</span>");
             click = false;
            }
            }
         });

           }
         }
        </script>
        @endif
@endsection



