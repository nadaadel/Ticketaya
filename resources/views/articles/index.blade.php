@extends('layouts.app')
@section('content')
  <div class="container">
  <div class="row">
        <div class="col-sm">
        <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                  </tr>
                </thead>
                <tbody>
          @foreach ($articles as $article)
        <tr>
        <td>{{$article->id}}</td>
        <td>{{$article->title}}</td>
        <td>{{$article->category->name}}</td>
        <td>
        <td> <a href={{ URL::to('/articles' . $article->id ) }} type="button" class="btn btn-success" >View</a> </td>
        </tr>
        @endforeach
     </tbody>
        </table>
     </div>
    </div>
  </div>
@endsection

