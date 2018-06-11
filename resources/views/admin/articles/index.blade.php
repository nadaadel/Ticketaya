@extends('admin.index')
@section('content')
<a href={{ URL::to('articles/create' )}} >
    <input type="button" class="btn btn-success" value='Create Article'/></a>
  <br/>
  <div class="container">
  <div class="row">
        <div class="col-sm">
        <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>

                  </tr>
                </thead>
                <tbody>
          @foreach ($articles as $article)
        <tr>
        <td>{{$article->id}}</td>
        <td>{{$article->title}}</td>
        <td>{{$article->category->name}}</td>

        <td>
        <td> <a href={{ URL::to('articles/' . $article->id ) }} type="button" class="btn btn-success" >View</a> </td>
        <td>    <a href={{ URL::to('articles/edit/' . $article->id ) }} type="button" class="btn btn-warning" >Edit</a></td>
        <td>    <form action="{{URL::to('articles/' . $article->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
                          {!! csrf_field() !!}
                          {{method_field('Delete')}}
            </form> </td>
        </td>
        </tr>
        @endforeach
     </tbody>
              </table>
            </div>
        </div>
  </div>
@endsection

