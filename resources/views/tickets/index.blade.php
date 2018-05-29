@foreach ($tickets as $ticket)

{{$ticket->name}}
<br>
Comments:
<br>
@foreach($ticket->comments as $comment)
{{$comment->body}}

<br>
@endforeach

<div class="card-body">
    <form method="POST" action="/tickets/{{$ticket->id}}/comment" enctype="multipart/form-data" >
         {{ csrf_field() }}

        <div class="form-group row">
            

                <div class="col-md-6">
                   <textarea rows="4" cols="50" placeholder="coment..."  name="body">
                   </textarea>
                  
                   <button type="submit" class="btn btn-primary">
                                    {{ __('Comment') }}
                    </button>
                               

                                
                          
                </div>
         </div>

                      
</div>                     
                      

 <hr>    
 

     
             




@endforeach
