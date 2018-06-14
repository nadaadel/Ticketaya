@extends('layouts.app')
@section('content')
   <h3> {{$article->title}}</h3>
    <img src="{{ asset('storage/images/articles/'. $article->photo) }}" style="width:150px; height:150px;">
</br>
    {{$article->description}} </br>
    {{$article->user->name}}  </br>
    {{$article->category->name}}
    <div class="follow text-center">
    @if($liker)

    <button id="like" class="btn btn-danger" article-id="{{$article->id}}">Dislike</button>
    <spam id="count">
    </spam>
    @else
    <button id="like" class="btn btn-primary " article-id="{{$article->id}}" >Like</button>
    <spam id="count">
    </spam>
    @endif
    
        

    </div>

</br>
    {{$article->created_at->diffForHumans()}}




{{-- comments and replies section --}}
<br>
Comments:
<br>
<br>
@foreach($article->comments as $comment)
{{$comment->user->name}}
<div>{{$comment->body}} created at :{{$comment->created_at->diffForHumans()}} </div>
<button   class="reply btn btn-primary" article-no="{{$article->id}}" comment-id="{{$comment->id}}" >Reply</button>
<div id="{{$comment->id}}" style="display: none;">
    <div class="card-body"  >
        <form method="POST" action="/articles/replies" enctype="multipart/form-data" >
         {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-md-6">
                   <textarea rows="3" cols="40" placeholder="reply here"  name="bodyReply">
                   </textarea>
                   <input  name="article_id" type="hidden"  value= {{$article->id}} >
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
    <form method="POST" action="/article/comments" enctype="multipart/form-data" >
         {{ csrf_field() }}
        <div class="form-group row">
                <div class="col-md-6">
                   <textarea rows="3" cols="45" placeholder="comment here"  name="body">
                   </textarea>
                   <input  name="article_id" type="hidden"  value= {{$article->id}} >
                   <button type="submit" class="btn btn-primary">
                                    {{ __('New Comment') }}
                    </button>
                </div>
         </div>
    </form>

</div>
<script>
$(function(){
$('.reply').on('click',function(){
    var commentId=$(this).attr("comment-id");
    $.ajax({
            url: '/articles/replies/'+commentId,
            type: 'GET',
            data: {
                '_token':'{{csrf_token()}}',
                 },
            success: function (response) {
            console.log(response);
            $('#'+commentId).show();
            for(var i=0;i<response.replies.length;i++){
                    $('#'+commentId).append('<div>'+response.names[i]+'</div>')
                    $('#'+commentId).append('<div>'+response.replies[i].body+'</div>' +'<br>')

            }
            }
            })
            $(this).hide();
  });



$('#like').on('click',function(){
    var articleId=$(this).attr('article-id');
   
    if ($(this).html()=="Like"){
        $.ajax({
                    type: 'GET',
                    url: '/articles/likes/'+articleId ,
                    data:{
                    '_token':'{{csrf_token()}}',
                    'id':articleId,
                    
                    
                    },
                    success: function (response) {
                        if(response.response=='success'){
                            console.log(response)
                            console.log('hii')
                            $('#like').html('Dislike');
                            $('#count').html(response.likes);
                            

                        }
                    }
                });

    }
    else{
        $.ajax({
                    type: 'GET',
                    url: '/articles/dislikes/'+articleId ,
                    data:{
                    '_token':'{{csrf_token()}}',
                    'id':articleId,
                   
                    },
                    success: function (response) {
                        if(response.response=='success'){
                          
                            $('#like').html('Like');
                            $('#count').html(response.likes);
                            
                        }
                    }
                });

    }


})

})


</script>


@endsection

