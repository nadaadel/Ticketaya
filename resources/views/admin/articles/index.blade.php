



@foreach ($articles as $article)
        {{$article->title}}
        {{$article->description}}
        {{$article->category}}
        {{$article->author}}


@endforeach
