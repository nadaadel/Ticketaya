@extends('admin.index')
@section('content')
<div class="container">

      <div class="row">
      <div class="col-sm">
            <a href={{ URL::to ('/users/create')}} ><input type="button" class="btn btn-success" value='Create User'/></a>
  <table class="table table-hover ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>

        <th scope="col">Photo</th>
        <th scope="col">Created At</th>
        <th scope="col" colspan='3'>Actions</th>
      </tr>
    </thead>
    <tbody>
  @foreach($users as $user)
  <tr id="{{$user->id}}">
        <th scope="row">{{$user->id}}</th>
        <td>{{ucwords($user->name)}}</td>

        <td><img src="{{ asset('storage/images/users/'.$user->avatar) }}" style="width:150px; height:150px;"></td>
        <td> {{ $user->created_at->diffForHumans() }} </td>
       <td> <a href={{ URL::to('users/' . $user->id ) }} class="btn btn-success" >View</a></td>
        <td><a href={{ URL::to('users/edit/' . $user->id ) }}  class="btn btn-warning" >Edit</a></td>
     <td>
     <td> <a user-id="{{$user->id}}" class="btn ctrl-btn  deleteuser"><i class="far fa-trash-alt"></i></a></td>
    </td>
  </tr>
  @endforeach
  </tbody>
  </table>
</div>
  </div>
  </div>
@endsection


