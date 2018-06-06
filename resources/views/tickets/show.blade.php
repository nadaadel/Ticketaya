@extends('layouts.app')

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
                  @if(Auth::user())
                  @role('admin')
                  Numbers of Spam :{{$numberofspams}}
                  @endrole
            @if(count($userSpam))
                @foreach ($userSpam as $spam)
                        @if($spam->ticket_id == $ticket->id)
                                <p style="color:red">  You Spammed This Ticket </p>
                                <br>
                        @endif
                    @endforeach
                @else
                 @if($ticket->user_id != Auth::user()->id)
                <form method="POST" action="/tickets/spam/{{$ticket->id}}">
                    @csrf
                <input class="btn btn-danger" type="submit" value="spam">
                </form>
                  @endif
                @endif
                {{-- end spam section --}}
                {{-- save ticket--}}
                @if($userSavedTicket)
                <button id="save_ticket" class="btn btn-danger">unsave</button>
                @else
                <button id="save_ticket" class="btn btn-primary">save</button>
                @endif
            @endif
                {{-- end save ticket--}}

                {{-- Request this ticket section --}}
        @if(Auth::user())
        <div class="requestticket">
        @if($ticket->user_id != Auth::user()->id  && $wantStatus == true)
        <input type="hidden" id="ticket-id" value="{{$ticket->id}}">
        <input id="quantity" type="number" name="quantity" placeholder="Quantitiy">
        <button  type="submit" class="want" class="btn btn-primary">I Want This Ticket</button>
        @endif
        </div>

        <div class="edit">
        @if($ticket->user_id != Auth::user()->id && $wantStatus == false)
        <input type="hidden" id="edit-ticket-id" value="{{$ticket->id}}">
        <input id="editquantity" type="number" name="editquantity" placeholder="Quantitiy">
        <button type="submit" class="editticket" class="btn btn-primary">Edit My Request</button>
        @endif
        </div>
        @endif

                {{-- Request this ticket end section --}}


{{-- comments and replies section --}}
<br>
Comments:
<br>
<br>
@foreach($ticket->comments as $comment)
{{$comment->user->name}}
<div>{{$comment->body}} created at :{{$comment->created_at->diffForHumans()}} </div>

<button   class="reply" ticket-no="{{$ticket->id}}" comment-id="{{$comment->id}}" >Reply</button>

<div id="{{$comment->id}}" style="display: none;">

    <div class="card-body"  >

        <form method="POST" action="/replies" enctype="multipart/form-data" >
         {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-md-6">
                   <textarea rows="4" cols="50" placeholder="reply here"  name="bodyReply">
                   </textarea>
                   <input  name="ticket_id" type="hidden"  value= {{$comment->ticket_id}} >
                   <input  name="comment_id" type="hidden"  value= {{$comment->id}} >
                   <button type="submit" class="btn btn-primary">
                                    {{ __('Reply') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<hr>
<br>
@endforeach
<div class="card-body">
    <form method="POST" action="/comments" enctype="multipart/form-data" >
         {{ csrf_field() }}
        <div class="form-group row">
                <div class="col-md-6">
                   <textarea rows="4" cols="50" placeholder="comment here"  name="body">
                   </textarea>
                   <input  name="ticket_id" type="hidden"  value= {{$ticket->id}} >
                   <button type="submit" class="btn btn-primary">
                                    {{ __('New Comment') }}
                    </button>
                </div>
         </div>
    </form>

</div>
<script src="//code.jquery.com/jquery.js"></script>
@include('flashy::message')
@if(Session::has('flashy_notification.message'))
<script id="flashy-template" type="text/template">
    <div class="flashy flashy--{{ Session::get('flashy_notification.type') }}">
        <i class="material-icons">speaker_notes</i>
        <a href="#" class="flashy__body" target="_blank"></a>
    </div>
</script>
<script>
    flashy("{{ Session::get('flashy_notification.message') }}", "{{ Session::get('flashy_notification.link') }}");
</script>
@endif

<script>
    $(document).ready( function(){
    $('.want').on('click' , function(){
            console.log('iam here');
            var quantity = $('#quantity').val();
            var ticket_id = $('#ticket-id').val();
            console.log(quantity);
            $.ajax({
                url: '/tickets/request/'+ticket_id,
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    'quantity':quantity
                },
                success:function(response){
                    console.log(response.response)
                   if(response.response =='ok'){
                    console.log(response.response);
                    alert('Ticket Requested Successfully');
                    $('.requestticket').hide();
                    $('.editticket').show();
                   }
                   else{
                    console.log(response);
                    alert('You Cant request this ticket ,Your quantity >'+response.quantity);
                   }
                }
            });
 });
 $('.editticket').on('click' , function(){
          //  $('#editquantity').show();
            var quantity  = $('#editquantity').val();
            console.log(quantity)
            var ticket_id = $('#edit-ticket-id').val();
            $.ajax({
                url: '/tickets/request/edit/'+ticket_id,
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    'quantity':quantity,
                    'ticket_id':ticket_id ,
                },
                success:function(response){
                    console.log(response.response)
                   if(response.response =='ok'){
                    console.log(response.response);
                    alert('Edit Requested Successfully');
                   }
                   else{
                    console.log(response);
                    alert('You Cant edit requested ticket ,Your quantity >'+response.quantity);
                   }
                }
            });
 });
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
            //console.log(response.replies)
            console.log(response.names);
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
       $('#save_ticket').on('click' , function(){
           console.log($(this).html());
           if($(this).html()=='save'){
         $.ajax({
             url: '/tickets/save/{{$ticket->id}}',
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            console.log(response);
            if(response.res == 'success'){
                $('#save_ticket').html('unsave');
                $("#save_ticket").attr('class', 'btn btn-danger');
            }
        }
         });
           }
           else
           if($(this).html()=='unsave'){
            $.ajax({
             url: '/tickets/unsave/{{$ticket->id}}',
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            console.log(response);
            if(response.res == 'success'){
                $('#save_ticket').html('save');
                $("#save_ticket").attr('class', 'btn btn-primary');
            }
            }
         });
        }
    });
});

</script>

@endsection
