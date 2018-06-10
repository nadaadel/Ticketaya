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
 </div>

@endsection
