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
  <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{ucwords($user->name)}}</td>

        <td><img src="{{ asset('storage/images/users/'.$user->avatar) }}" style="width:150px; height:150px;"></td>
        <td> {{ $user->created_at->diffForHumans() }} </td>
<td>
    <a href={{ URL::to('users/' . $user->id ) }} type="button" class="btn btn-success" >View</a></td>
        <td><a href={{ URL::to('users/edit/' . $user->id ) }} type="button" class="btn btn-warning" >Edit</a></td>
     <td>
     <form action="{{URL::to('users/' . $user->id ) }}" onsubmit="return confirm('Do you really want to delete?');" method="post" ><input name="_method" value="delete" type="submit" class="btn btn-danger" />
      {!! csrf_field() !!}
      {{method_field('Delete')}}
    </form>
    </td>
  </tr>
  @endforeach
  </tbody>
  </table>
</div>
  </div>
  </div>
@endsection


