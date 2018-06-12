@extends('layouts.app')
@section('content')
           <section id="ticket-view">
               <div class="container">
                   <div class="row ">
                       <div class="col-md-3 col-xs-12 text-center"><!--User profile-->
                           <div class="user-img">
                               <div style="background-image: url(../images/icons/avatar.jpg);"></div><!--User logged img-->

                            </div>
                           <h4 class="user-name pt-4">{{ $ticket->user->name }}</h4>
                           <div class="user-loc d-flex justify-content-center">
<!--                               <i class="fas fa-map-marker gray"></i>-->
                               <p class="gray">{{ $ticket->city->name }}</p>
                           </div>
                           <button class="btn btn-info"> Chat with Seller</button>
                       </div><!--End of User profile-->
                       <div class="col-md-9 pb-5"><!--Ticket data-->
                           <div class="row">
                               <div class="col-md-8 col-xs-12 ticket-details">
                                   <div class="ticket-img" style="background-image: url(../images/home/1-silder.jpg);"></div>
                                   <div class="tick-name-price pt-5 d-flex justify-content-between  ">
                                       <h3>{{ $ticket->name }}</h3>
                                       <h3 class="price">{{ $ticket->price }} L.E</h3>
                                   </div>
                                   <div class="ticket-info">
                                       <ul>

                                           <li><i class="fa fa-spinner"></i> Available Tickets :{{ $ticket->quantity }}</li>

                                           <li><i class="fas fa-th-large"></i> {{ $ticket->category->name }}</li>
                                           <li><i class="far fa-calendar-alt"></i>Posted at : {{ $ticket->created_at->diffForHumans() }} </li>
                                           <li><i class="far fa-calendar-alt"></i>expire at : {{ $ticket->created_at->diffForHumans() }} </li>

                                           <li><i class="fas fa-map-marker"></i>{{ $ticket->region->name }},{{ $ticket->city->name }}</li>
                                       </ul>
                                   </div>


                {{-- Request this ticket end section --}}
        @if(Auth::user())
           @if($ticket->user_id != Auth::user()->id  && $wantStatus == true && $ticket->is_sold == 0)
                <div class="requestticket" id="RequestTicket">
                                   <div class="ticket-actions row">
                                       <div class="col-md-6 d-flex">
                                           <h4>Quantity</h4>
                                           <select name="quantity" id="quantity">
                                               @for($i =1 ; $i<= $ticket->quantity ; $i++)
                                           <option  value="{{$i}}">{{$i}}</option>
                                               @endfor
                                            </select>
                                       </div>
                                <input type="hidden" id="ticket-id" value="{{$ticket->id}}">
                                       <div class="col-md-6">
                                           <a  href="#"   id="want" class="btn btn-primary">REQUST THIS TICKET</a>
                                       </div>
                                   </div>
                </div>
            @endif

                {{-- Request this ticket end section --}}
                @if($request&&$request->is_accepted==0)
                <div id="loginuser">
                <a  href="#" id="editshow"  class="btn btn-primary">Edit My Request</a>
                </div>
               @endif

                <div class="editrequest" id="editrequest" style="display: none;">
                <input type="hidden" id="edit-ticket-id" value="{{$ticket->id}}">
                <h4>Quantity</h4>
                <select class="w-25" name="editquantity" id="editquantity">
                    @for($i =1 ; $i<= $ticket->quantity ; $i++)
                <option  value="{{$i}}">{{$i}}</option>
                    @endfor
                 </select>
                <button href="#" id="editticket" class="btn btn-success">Edit</button>
               </div>

                {{-- Edit Request this ticket end section --}}

                               </div>
                               <div class="col-md-4 col-xs-12 pr-2">
                                   <h3 class="mb-3">Ticket Details</h3>
                                   <p class="mb-5">
                                    {{$ticket->description}}
                                   </p>
                                   <h3 class="mb-3">You Should Know</h3>
                                   <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper, ante in ornare scelerisque, ex mauris luctus dui, sed egestas justo quam suscipit arcu. Vestibulum ante ipsum.
                                </p>
                             @if($ticket->tags)
                                <h3 class="mb-3">Tags</h3>
                                    <p>
                                        @foreach($ticket->tags as $tag)
                                        <a href={{ URL::to('tags/'.$tag->id.'/tickets') }} type="button" class="btn btn-success" >{{$tag->name}}</a>
                                        @endforeach
                                    </p>
                             @endif
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
                                                {{ $ticket->description }}
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
                <a href={{ URL::to('tickets/report/' . $ticket->id ) }} type="button" class="btn btn-danger" >Report</a>
            @endif
        @endif
                {{-- end save ticket--}}




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
@endif
</hr>
@if(sizeof($recommendedArticles) > 0)
<section class="recommended-articles">
        <div class="container">
                <h2>Recommended Articles</h2>
                <div class="row  mt-5 mb-5">
                        @foreach($recommendedArticles as $article)
                                <div class="col-md-6 col-12 mb-6"><!--event card starts here-->
                                   <a href="{{ URL::to('articles/' . $article->id ) }}">
                                        <div class="event-card">
                                            <div href="{{ URL::to('articles/' . $article->id ) }}" class="event-img" style="background-image: url({{ asset('storage/images/articles/'. $article->photo) }});">
                                            </div>
                                            <div class="event-content">
                                                <a href="{{ URL::to('articles/' . $article->id ) }}"><h3>{{ucwords($article->title)}}</h3></a>
                                                <p>{{substr($article->description,0,200)}}.</p>
                                            </div>
                                            <div class="follow text-center">
                                                    <a class="btn btn-primary" href="{{ URL::to('articles/' . $article->id ) }}">Read More</a>

                                            </div>
                                        </div>
                                    </a>
                                </div><!--event card starts here-->
                        @endforeach
                        </div>
        </div>
</section>
@endif

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
    $('#want').on('click' , function(){
            var quantity = $('#quantity').val();
            console.log(quantity);

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
                    $('#loginuser').show();

                   }
                   else{
                    console.log(response);
                    alert('You Cant request this ticket ,Your quantity must be >'+response.quantity+' and >0');
                   }
                }
            });

 });


 $('#editshow').on('click' , function(){
        $('#editrequest').show();
        $(this).hide();
 });

 $('#editticket').on('click' , function(){
            var quantity  = $('#editquantity').val();
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
                    //console.log(response.response)
                   if(response.response =='ok'){
                   // console.log(response.response);
                    console.log(response.ticket )

                    alert('Edit Requested Successfully');
                   }
                   else{
                    console.log(response);
                   alert('You Cant edit requested ticket ,Your quantity must be >'+response.quantity+'and >0');
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
