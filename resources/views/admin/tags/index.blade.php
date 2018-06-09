@extends('admin.index')
@section('content')

  <div class="container">
        <a href={{ URL::to('/tags/create' )}} >
            <input type="button" class="btn btn-success" value='Create New Tag'/></a>
        <table class="table table-hover table-dark">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col" colspan="4">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag )
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td><a href="{{ URL::to('/tags/show/'.$tag->id ) }}"><input class="btn btn-success" type="submit" value="Show"></a></td>
                    <td><a href="{{ URL::to('/tags/'.$tag->id.'/tickets')}}" class="btn btn-success">Show related tickets</a></td>
                        <td><a href={{ URL::to('/tags/edit/'.$tag->id ) }}><input type="submit" class="btn btn-warning" value="Edit"></a></td>
                           <td> <form method="POST" action="/tags/delete/{{$tag->id}}">
    @csrf
    {{method_field('DELETE')}}
      <input type="submit" class="btn btn-danger" value="Delete">
    </form>
</td>
</tr>
@endforeach
</tbody>
      </table>
</div>
@endsection
