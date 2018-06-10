@extends('layouts.app')

@section('content')
           
           
           <section id="ticket-view">
               <div class="container">
                   <div class="row ">
                       <div class="col-md-3 col-xs-12 text-center"><!--User profile-->
                           <div class="user-img">
                               <div style="background-image: url(../images/icons/avatar.jpg);"></div><!--User logged img-->
                           </div>
                           <h4 class="user-name pt-4">Adam Smith</h4>
                           <div class="user-loc d-flex justify-content-center">
<!--                               <i class="fas fa-map-marker gray"></i>-->
                               <p class="gray">Alexandria</p>
                           </div>
                           <button class="btn btn-info"> Chat with Seller</button>
                       </div><!--End of User profile-->
                       <div class="col-md-9 pb-5"><!--Ticket data-->
                           <div class="row">
                               <div class="col-md-8 col-xs-12 ticket-details">
                                   <div class="ticket-img" style="background-image: url(../images/home/1-silder.jpg);"></div>
                                   <div class="tick-name-price pt-5 d-flex justify-content-between  ">
                                       <h3>Ticket Name Here</h3>
                                       <h3 class="price">120 L.E</h3>
                                   </div>
                                   <div class="ticket-info">
                                       <ul>
                                           <li><i class="fas fa-th-large"></i> Sport</li>
                                           <li><i class="far fa-calendar-alt"></i> Sat, 18 Jul 2018 </li>
                                           <li><i class="fas fa-map-marker"></i>City Center, Alexandria</li>
                                       </ul>
                                   </div>
                                   <div class="ticket-actions row">
                                       <div class="col-md-6 d-flex">
                                           <h4>Quantity</h4>
                                           <select>
                                                <option selected value="1">1</option>
                                                <option  value="2">2</option>
                                                <option  value="3">3</option>
                                                <option  value="4">4</option>
                                            </select>
                                       </div>
                                       <div class="col-md-6">
                                           <a  href="#" class="btn btn-primary">REQUST THIS TICKET</a>
                                       </div>
                                   </div>
                                   
                               </div>
                               <div class="col-md-4 col-xs-12 pr-2">
                                   <h3 class="mb-3">Ticket Details</h3>
                                   <p class="mb-5">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas.
                                   </p>
                                   <h3 class="mb-3">You Should Know</h3>
                                   <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                                    </p>
                               </div>
                           </div>
                       </div><!--end of Ticket data-->
                   </div>
               </div>
               <div class="container">
                   <div class="row comments"><!--comments section -->
                       <div class="col-md-12">
                          <h2>Visitors Comments</h2>
                           <div class="col-md-12">
                              <form>
                               <div class="row">
                                  
                                   <div class="col-sm-4 col-md-3">
                                       <div class="usr-img-cmnt float-right" style="background-image: url(../images/icons/avatar.jpg);"></div><!--logged in user img -->
                                   </div>
                                   <div class="col-sm-8 col-md-6 col-sm-8">
                                       <input type="text" placeholder="Leave comment Here ....">
                                   </div>
                                   <div class=" col-sm-12 col-md-3  pt-3">
                                       <input type="submit" value="NEW COMMENT" class="btn btn-secondary">
                                   </div>
                               </div>
                               </form>
                           </div>
                           <div class="col-md-12 users-comment">
                              <div class="row"> <!--every comment here -->
                                   <div class="col-sm-4 col-md-3">
                                       <div class="usr-img-cmnt float-right" style="background-image: url(../images/icons/avatar.jpg);"></div><!--commented user img -->
                                   </div>
                                   <div class="col-sm-8 col-md-6 col-sm-8">
                                       <div class="comment-content">
                                           <h4>Adam Smith</h4>
                                           <p class="gray">3 hours ago</p>
                                           <p>
                                               Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                                           </p>
                                           <a href="#" class="info">REPLAY</a>
                                       </div>
                                   </div>
                               </div> <!-- end of every comment -->
                               <div class="row"> <!--every comment here -->
                                   <div class="col-sm-4 col-md-3">
                                       <div class="usr-img-cmnt float-right" style="background-image: url(../images/icons/avatar.jpg);"></div><!--commented user img  -->
                                   </div>
                                   <div class="col-sm-8 col-md-6 col-sm-8">
                                       <div class="comment-content">
                                           <h4>Adam Smith</h4>
                                           <p class="gray">3 hours ago</p>
                                           <p>
                                               Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                                           </p>
                                           <a href="#" class="info">REPLAY</a>
                                           <div class="row mt-5">
                                                <div class="col-sm-4 col-md-2">
                                                   <div class="usr-img-cmnt" style="background-image: url(../images/icons/avatar.jpg);"></div><!--user logged img -->
                                               </div>
                                               <div class="col-sm-12 col-md-10">
                                                   <input type="text" placeholder="Leave comment Here ....">
                                                   <input type="submit" value="NEW COMMENT" class="btn btn-secondary mt-3">
                                               </div>
                                               <div class=" col-sm-12 col-md-3  pt-3">
                                                   
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div> <!-- end of every comment -->
                            </div>

                       </div>
                   </div><!--end of comments section -->
               </div>
           </section>

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
            @if($ticket->user_id != Auth::user()->id)
                @if($userSavedTicket)
                <button id="save_ticket" class="btn btn-danger">unsave</button>
                @else
                <button id="save_ticket" class="btn btn-primary">save</button>
                @endif
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
<!-- quantity dropdown script-->
<script>
    $(".custom-select").each(function() {
      var classes = $(this).attr("class"),
          id      = $(this).attr("id"),
          name    = $(this).attr("name");
      var template =  '<div class="' + classes + '">';
          template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
          template += '<div class="custom-options">';
          $(this).find("option").each(function() {
            template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
          });
      template += '</div></div>';

      $(this).wrap('<div class="custom-select-wrapper"></div>');
      $(this).hide();
      $(this).after(template);
    });
    $(".custom-option:first-of-type").hover(function() {
      $(this).parents(".custom-options").addClass("option-hover");
    }, function() {
      $(this).parents(".custom-options").removeClass("option-hover");
    });
    $(".custom-select-trigger").on("click", function() {
      $('html').one('click',function() {
        $(".custom-select").removeClass("opened");
      });
      $(this).parents(".custom-select").toggleClass("opened");
      event.stopPropagation();
    });
    $(".custom-option").on("click", function() {
      $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
      $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
      $(this).addClass("selection");
      $(this).parents(".custom-select").removeClass("opened");
      $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
    });
</script>
<!-- end of quantity dropdown script-->

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
