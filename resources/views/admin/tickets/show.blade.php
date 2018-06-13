@extends('admin.index')
@section('content')

           <fieldset>
                    <legend style="background-color: gray">Ticket Info </legend>
                    <img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style="width:150px; height:150px;">
                    <p>Name : {{ $ticket->name }}</p>
                    <p>Quantity:{{ $ticket->quantity }}</p>
                    <p>Description:{{ $ticket->description }}</p>
                    <p>Price :{{ $ticket->price }}</p>
                    <p>Date :{{ $ticket->expire_date }}</p>
                    <p>Category :{{ $ticket->category->name }}</p>
                    <p>Location:{{ $ticket->region->name }},{{ $ticket->city->name }}</p>
                    <p>Created by :{{ $ticket->user->name }} </p>
                                                         {{-- save ticket--}}
                                                         @if(Auth::check() )
                                                         <a class="btn ctrl-btn like-btn container">
                                                              @if(Auth::user()->savedTickets->contains($ticket->id))
                                                              <i class='fas fa-heart heart'></i>
                                                              @else
                                                              <i class='far fa-heart heart'></i>
                                                              @endif
                                                          </a>
                                                          @endif
                                                              {{-- end save ticket--}}
                    @if($ticket->tags)
                    <p>
                        @foreach($ticket->tags as $tag)
                        <a href={{ URL::to('tags/'.$tag->id.'/tickets') }} type="button" class="btn btn-success" >{{$tag->name}}</a>
                        @endforeach
                    </p>
                    @endif
                   <hr>
                </fieldset>
                  {{-- spam section --}}
                  Numbers of Spam :{{$numberofspams}}
{{-- comments and replies section --}}
<br>
Comments:
<br>
<br>
@foreach($ticket->comments as $comment)
{{$comment->user->name}}
<div>{{$comment->body}} created at :{{$comment->created_at->diffForHumans()}} </div>

<button   class="reply" ticket-no="{{$ticket->id}}" comment-id="{{$comment->id}}" >Show Replies</button>

<div id="{{$comment->id}}" style="display: none;">
    <div class="card-body">
    </div>
</div>
<hr>
<br>
@endforeach
<script src="//code.jquery.com/jquery.js"></script>
<script>
    $(document).ready( function(){
$('.reply').on('click',function(){
    var elem = this;
    var ticketId=$(this).attr("ticket-no");
    var commentId=$(this).attr("comment-id");
    $.ajax({
            url: '/replies/'+commentId,
            type: 'GET',
            data: {
                '_token':'{{csrf_token()}}',
                 },
            success: function (response) {
            $('#'+commentId).show();
            for(var i=0;i<response.replies.length;i++){

               for (var j=0;j<response.names.length;j++){
                if (i==j){
                    $('#'+commentId).append('<div>'+response.names[j]+'</div>')
                    $('#'+commentId).append('<div>'+response.replies[i].body+'</div>' +'<br>')

               }

            }
            }


            }
            })
            $(this).hide();
  });
});
  </script>
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
