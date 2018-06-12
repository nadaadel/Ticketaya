@extends('layouts.app')
@section('content')
<div id="fh5co-page">
	<div id="fh5co-blog-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2>Our Blog</h2>
				</div>
            </div>
        @if($articles)
			<div class="row">
				<div class="col-md-12 text-center">
               {{-- <div class="row"> --}}
                    @foreach ($articles as $article)
						<div class="col-md-4 text-center">
							<div class="blog-inner">
								<a href="/articles/{{$article->id}}"><img class="img-responsive" src="{{ asset('storage/images/articles/'. $article->photo) }}" alt="Blog"></a>
								<div class="desc">
									<h3><a href="/articles/{{$article->id}}">{{$article->title}}</a></h3>
									<p>{{substr($article->description,0,150)}}.</p>
									<p><a href="/articles/{{$article->id}}" class="btn btn-primary">Read More</a></p>
								</div>
							</div>
                        </div>
                    @endforeach
					{{--</div> --}}
                </div>
            </div>
        @endif

		</div>
	</div>
</div>

@endsection


























