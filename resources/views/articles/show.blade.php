@extends('layouts.app')
@section('content')
  <section>
      <div class="container">
          <div class="row justify-content-center mt-5">
              <div class="col-md-10">
                  <div class="row">
                      <div class="col-md-4 col-12">
                          <img src="{{ asset('storage/images/articles/'. $article->photo) }}" style="width:150px; height:150px;">
                      </div>
                      <div class="col-md-8 col-12">

                          <h2>{{$article->title}}</h2>
                          <div class="article-info">
                             <p><span></span>{{$article->created_at->diffForHumans()}}</p>
                             <p><span>Article Type </span>{{$article->category->name}}</p>
                             <p><span>By </span>{{$article->user->name}}</p>
                              <div class="article-like">
                              @if(Auth::check())
                                <div class="follow text-center">
                                @if($liker)

                                <button id="like" class="btn btn-danger" article-id="{{$article->id}}">Dislike</button>
                                <span id="count" class="pl-3">
                                </span>
                                @else
                                <button id="like" class="btn btn-primary " article-id="{{$article->id}}" >Like</button>
                                <span id="count" class="pl-3">
                                </span>

                                @endif
                                </div>
                                @endif
                          </div>
                          </div>

                      </div>
                  </div>
                  <div class="row justify-content-center mt-5 mb-5">
                      <div class="col-md-12">
                          <p>{{$article->description}}</p>
                      </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                         <h2>Comments</h2>
                         @if(Auth::check())
                         <div class="card-body">
                                <form method="POST" action="/article/comments" enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                    <div class="form-group row">
                                            <div class="col-md-6">
                                               <textarea  placeholder="comment here"  name="body" class="w-100 d-block">
                                               </textarea>
                                               <input  name="article_id" type="hidden"  value= {{$article->id}} >
                                               <button type="submit" class="btn btn-secondary mt-2">
                                                                {{ __('New Comment') }}
                                                </button>
                                            </div>
                                     </div>
                                </form>

                            </div>
                        @else
                            <div class="card-body">
                                <form method="POST" action="/article/comments" enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                    <div class="form-group row">
                                            <div class="col-md-6">
                                               <textarea  placeholder="  Login to Comment"  name="body" class="w-100 d-block"></textarea>
                                            </div>
                                     </div>
                                </form>

                            </div>
                        @endif
                     </div>
                      <div class="col-md-12">
                        @foreach($article->comments as $comment)
                            @if($comment->user)
                            <div comment-no="{{$comment->id}}">
                            <h4>{{$comment->user->name}}</h4>
                            <p><span>Created from </span>{{$comment->created_at->diffForHumans()}}</p>
                            <p>{{$comment->body}}</p>
                                @if(Auth::check()&&(Auth::user()->id==$comment->user->id||Auth::user()->id==$article->user_id||Auth::user()->hasRole('admin')))
                                <button class=" deleteCommment btn  btn-danger float-right" comment-id="{{$comment->id}}">delete</button>
                                @endif
                            <button   class="reply btn btn-primary" article-no="{{$article->id}}" comment-id="{{$comment->id}}" >Reply</button>
                            <div class="card-body" id="{{$comment->id}}" style="display: none;">
                                    @if(Auth::check())
                                    <form method="POST" action="/articles/replies" enctype="multipart/form-data" >
                                     {{ csrf_field() }}
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                               <textarea placeholder=" reply here"  name="bodyReply"></textarea>
                                               <input  name="article_id" type="hidden"  value= {{$article->id}} >
                                               <input  name="comment_id" type="hidden"  value= {{$comment->id}} >
                                               <button type="submit" class="btn btn-info">
                                                                {{ __('Reply') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                           <div class="form-group row">
                                               <div class="col-md-6">
                                                  <textarea placeholder=" Login to Reply"  name="bodyReply"></textarea>
                                               </div>
                                            </div>
                                    @endif
                                </div>
                            <hr>
                            <br>
                            </div>
                            @endif
                        @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>





{{-- comments and replies section --}}


<script>
$(function(){
    $('.deleteCommment').on('click',function(){
        var id=$(this).parent().attr('comment-no');
        var comment_div=$(this).parent();
        console.log(id)
        $.ajax({
                url: '/article/comments/delete/'+id,
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    '_method':'DELETE',
                    'id':id,

                },
                success:function(response){
                    $(comment_div).remove();
                }

        })

    });
$('.reply').on('click',function(){
    var commentId=$(this).attr("comment-id");
    $.ajax({
            url: '/articles/replies/'+commentId,
            type: 'GET',
            data: {
                '_token':'{{csrf_token()}}',
                 },
            success: function (response) {
            $('#'+commentId).show();
            for(var i=0;i<response.replies.length;i++){
                    $('#'+commentId).append('<h4>'+response.names[i]+'</h4>')
                    $('#'+commentId).append('<p>'+response.replies[i].body+'</p>' )
                    $('#'+commentId).append('<p class="gray">'+response.replies[i].created_at+'</p>' +'<br>')

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

