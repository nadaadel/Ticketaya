@extends('layouts.app')
@section('content')
   <h3> {{$article->title}}</h3>
    <img src="{{ asset('storage/images/articles/'. $article->photo) }}" style="width:150px; height:150px;">
</br>
    {{$article->description}} </br>
    {{$article->user->name}}  </br>
    {{$article->category->name}}

</br>
    {{$article->created_at->diffForHumans()}}
@endsection
