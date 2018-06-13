@extends('admin.index')
@section('content')

<section id="ticket-view">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 col-xs-12 text-center"><!--User profile-->
                    <div class="user-img">
                        <div style="background-image: url({{ asset('storage/images/users/'.$ticket->user->avatar ) }});"></div><!--User logged img-->

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
                            <div class="ticket-img" style="background-image: url({{ asset('storage/images/tickets/'. $ticket->photo) }});"></div>
                            <div class="tick-name-price pt-5 d-flex justify-content-between  ">
                                <h3>{{ $ticket->name }}</h3>
                                <h3 class="price">{{ $ticket->price }} L.E</h3>
                            </div>
                              {{-- save ticket--}}
                              @if(Auth::check() )
                            <a class="btn ctrl-btn like-btn container">
                                 @if(Auth::user()->savedTickets->contains($ticket->id))
                                 <i class='fas fa-heart heart'></i>
                                 @else
                                 <i class='far fa-heart heart'></i>
                                 @endif
                             </a>
                                 {{-- end save ticket--}}
                            <div class="ticket-info">
                                <ul>
                                    <li><i class="fa fa-spinner"></i> Available Tickets :{{ $ticket->quantity }}</li>
                                    <li><i class="fas fa-th-large"></i> {{ $ticket->category->name }}</li>
                                    <li><i class="far fa-calendar-alt"></i>Posted at : {{ $ticket->created_at }}, {{ $ticket->created_at->diffForHumans() }} </li>
                                    <li><i class="far fa-calendar-alt"></i>Expired at : {{ $ticket->expire_date }} </li>
                                    <li><i class="fas fa-map-marker"></i>{{ $ticket->region->name }},{{ $ticket->city->name }}</li>
                                </ul>
                            </div>
                            @endif
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
                                 <a href={{ URL::to('tags/'.$tag->id.'/tickets') }}  class="btn btn-success" >{{$tag->name}}</a>
                                 @endforeach
                             </p>
                      @endif

                      @role('admin')
                      {{-- spam section --}}
                      <h3>Numbers of Spam
                          <br/>{{$numberofspams}}</h3>
                      <a href="{{ URL::to('tickets/edit/' . $ticket->id ) }}" class="btn ctrl-btn edit-btn"><i class="far fa-edit"></i></a>
                      <a  class="btn ctrl-btn delete-btn"><i class="far fa-trash-alt deletebtn"></i></a>
                      @endrole
                        </div>
                    </div>
                </div><!--end of Ticket data-->
            </div>
        </div>
        <div class="container">

            <div class="row comments"><!--comments section -->
                <div class="col-md-12">
                   <h2>Visitors Comments</h2>
                    <div class="col-md-12 users-comment">
                 @foreach($ticket->comments as $comment)
                       <div class="row"> <!--every comment here -->
                            <div class="col-sm-4 col-md-3">
                                <div class="usr-img-cmnt float-right" style="background-image: url(../images/icons/avatar.jpg);"></div><!--commented user img -->
                            </div>
                            <div class="col-sm-8 col-md-6 col-sm-8">
                                <div class="comment-content">
                                    <h4>{{$comment->user->name}}</h4>
                                    <p class="gray">3 {{$comment->created_at->diffForHumans()}}</p>
                                    <p>
                                         {{$comment->body}}                                           </p>
                                    <a  class="btn btn-primary info reply" ticket-no="{{$ticket->id}}" comment-id="{{$comment->id}}" >REPLIES</a>
                                 <div id="{{$comment->id}}" style="display: none;">
                                </div>

                                 </div>
                            </div>
                        </div> <!-- end of every comment -->

                 @endforeach
                     </div>

                </div>
            </div><!--end of comments section -->
        </div>
    </section>

<hr>
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
          <script>
                $(document).on('click','.deletebtn',function(){
                        var ticket_id ={!! json_encode($ticket->id)!!}
                        var resp = confirm("Do you really want to delete this ticket?");
                        if (resp == true) {
                            $.ajax({
                                type: 'POST',
                                url: '/tickets/'+floor_id ,
                                data:{
                                '_token':'{{csrf_token()}}',
                                '_method':'DELETE',
                                },
                                success: function (response) {
                                    if(response.res=='success'){

                                    }
                                }
                            });

                        }
                       });
                </script>
           @endif


@endsection
