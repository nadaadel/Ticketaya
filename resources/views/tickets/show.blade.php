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
                    <p>Category :{{ $ticket->category_id }}</p>
                    <p>Location:{{ $ticket->region }},{{ $ticket->city }}</p>
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
            @if(count($userSpam))
                @foreach ($userSpam as $spam)
                        @if($spam->ticket_id == $ticket->id)
                                <p style="color:red">  You Spammed This Ticket </p>
                                <br>
                        @endif
                @endforeach
            @else
                @if($ticket->id != Auth::user()->id)
                <form method="POST" action="/tickets/spam/{{$ticket->id}}">
                    @csrf
                <input class="btn btn-danger" type="submit" value="spam">
                </form>
                @endif
            @endif
                {{-- end spam section --}}

                {{-- Request this ticket section --}}
        <div class="requestticket">
        {{-- <form method="POST" action="/tickets/request/{{$ticket->id}}"> --}}
            {{-- @csrf --}}
        @if($ticket->user_id != Auth::user()->id)
        <input type="hidden" id="ticket-id" value="{{$ticket->id}}">
        <input id="quantity" type="number" name="quantity" placeholder="Quantitiy">
   
        <button   type="submit" class="want" class="btn btn-primary">I Want This Ticket</button>
        @endif
        {{-- </form> --}}
        </div>

        <div class="edit" style="display: none;">
        {{-- <form method="POST" action="/tickets/request/edit/{{$ticket->id}}"> --}}
            {{-- @csrf --}}
        @if($ticket->user_id != Auth::user()->id)
        <input type="hidden" id="edit-ticket-id" value="{{$ticket->id}}">
        <input id="editquantity" type="number" name="editquantity" placeholder="Quantitiy">
   
        <button   type="submit" class="editticket" class="btn btn-primary">edit requested ticket</button>
        @endif
        {{-- </form> --}}
        </div>
        

                {{-- Request this ticket end section --}}


<br>
Comments:
<br>
@foreach($ticket->comments as $comment)
{{$comment->body}}

<button  id="ticket" class="reply" ticket-no="{{$ticket->id}}" comment-id="{{$comment->id}}" >Reply</button>

<div class="replies" style="display: none;">

<div class="card-body" style="display: none;" id="form" >

    <form method="POST" action="/replies" enctype="multipart/form-data" class="formreply">
         {{ csrf_field() }}
        <div class="form-group row">
                <div class="col-md-6">
                   <textarea rows="4" cols="50" placeholder="comment here"  name="bodyReply">
                   </textarea>
                   <input  name="ticket_id" type="hidden"  value= {{$comment->ticket_id}} >
                   <input  name="comment_id" type="hidden"  value= {{$comment->id}} >
                   <button type="submit" class="btn btn-primary">
                                    {{ __('send') }}
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
                                    {{ __('Comment') }}
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
                   }
                   else{
                    console.log(response);  
                    alert('You Cant request this ticket ,Your quantity >'+response.quantity);

                   }

                   $('.requestticket').hide();
                   $('.edit').show();
                   
                   
                   
                }
            });
 });

 $('.editticket').on('click' , function(){
            console.log('iam here');
            var quantity = $('#editquantity').val();

            var ticket_id = $('#edit-ticket-id').val();
            console.log(quantity);
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
                    alert('Ticket Requested Successfully');
                   }
                   else{
                    console.log(response);  
                    alert('You Cant edit requested ticket ,Your quantity >'+response.quantity);

                   }

                 
                   
                   
                }
            });
 });



})


  $(document).on('click','.reply', function () {

         var elem = this;
             ticketId=$(this).attr("ticket-no");
            commentId=$(this).attr("comment-id");
            $.ajax({
                url: '/replies/'+commentId,
                 type: 'GET',
                 data: {
                    '_token':'{{csrf_token()}}',
                },
                success: function (response) {
                   console.log(response.response.length)
                   $('.formreply').show();
                   for(var i=0;i<response.response.length;i++){
                        $('.replies').show();                        
                        $('.replies').append(response.response[i].body +'<br>')
                       console.log(response.response[i])
                  }
                 
                   
                }

            })


  });



           
 

</script>

@endsection
