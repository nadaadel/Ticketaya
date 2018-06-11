@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
   <h3> {{$article->title}}</h3>
    <img src="{{ asset('storage/images/articles/'. $article->photo) }}" style="width:600px; height:450px;">
</br>
    {{$article->description}} </br>
    {{$article->user->name}}  </br>
    {{$article->category->name}}

</br>
    {{$article->created_at->diffForHumans()}}
</div>
{{-- comments and replies section --}}
<br>
Comments:
<br>
<br>
@foreach($article->comments as $comment)
{{$article->user->name}}
<div>{{$article->body}} created at :{{$comment->created_at->diffForHumans()}} </div>

<button   class="reply" article-no="{{$article->id}}" comment-id="{{$comment->id}}" >Show Replies</button>

<div id="{{$comment->id}}" style="display: none;">
    <div class="card-body">
    </div>
</div>
<hr>
<br>
@endforeach
 </div>
 <script>
    $(document).ready( function(){
$('.reply').on('click',function(){
    var elem = this;
    var articleId=$(this).attr("article-no");
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


@endsection
