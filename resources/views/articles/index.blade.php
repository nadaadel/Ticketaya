@extends('layouts.app')
@section('content')
@if($articles)
<div class="row">
<h3 class="text-center">Articles</h3>
 @foreach ($articles as $article)
 <div class="col-md-4 col-xs-12 tick-search ticket-card-parent">
        <div class="card ticket-card">
            <div class="card-img"  style=" background-image: url({{ asset('storage/images/articles/'. $article->photo) }});">

            </div>

            <div class="card-body">
                <h3 class="card-title">{{$article->title}} </h3>
                <p class="ticket-des">{{substr($article->description,0,150)}}</p>
                <div class="ticket-btn text-center">
                    <a type="button" href="/articles/{{$article->id}}" type="button" class="btn btn-primary">Read More</a>
                </div>

            </div>
        </div>
    </div>
 @endforeach
</div>
@endif
@endsection

