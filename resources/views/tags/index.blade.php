<form method="GET" action="/tags/create">
    @csrf
      <input type="submit" value="Create New Tag">
</form>

@foreach ($tags as $tag )
  {{ $tag->name }}
  <form method="GET" action="/tags/show/{{$tag->id}}">
    @csrf
      <input type="submit" value="Show">
    </form>
     <form method="GET" action="/tags/edit/{{$tag->id}}">
        @csrf
          <input type="submit" value="Edit">
        </form>
  <form method="POST" action="/tags/delete/{{$tag->id}}">
    @csrf
    {{method_field('DELETE')}}
      <input type="submit" value="Delete">
    </form>
@endforeach
