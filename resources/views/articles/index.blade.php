@extends('layouts.app')
@section('content')
<section>
<div class="container">
        <div class="row">
                <div class="col-md-12  mt-3 text-center">
                    <h2 style="font-family:sans-serif">Our Blog</h2>
                </div>
            </div>
<div class="row  mt-5 mb-5">
@foreach($articles as $article)
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

@endsection






















