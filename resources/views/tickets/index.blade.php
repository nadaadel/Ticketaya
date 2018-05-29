
@foreach ($tickets as $ticket)

{{$ticket->name}}
<br>
Comments:
<br>
@foreach($ticket->comments as $comment)
{{$comment->body}}
<button class="reply" ticket-no="{{$ticket->id}}" comment-id="{{$comment->id}}" >Reply</button>
<div id="replies" style="display: none;">  

<div class="card-body" style="display: none;" id="form" >

    <form method="POST" action="/replies" enctype="multipart/form-data" >
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
                      

 <hr>   
 

@endforeach






<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script type="text/javascript"></script> 

<script>
 $(document).on('click','.reply', function () {
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
                   for(var i=0;i<response.response.length;i++){
                       $('#replies').show();
                       $('#replies').append(response.response[i].body +'<br>')

                      
                       console.log(response.response[i])
                   }
                   $('#form').show();
                    
                    
                }

            });

        
       
       });


</script>

