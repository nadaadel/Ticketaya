@extends('admin.index')
@section('content')

{{ $user->name}} Profile <br>
   

  Email<div>{{$user->email}}</div>
  @if($user->avatar)
   Avatar<img src="{{ asset('storage/images/users/'. $user->avatar) }}" style="width:150px; height:150px;"></td>
  @endif
  <br>
  @if($user->city)
  City:<div>{{$user->city->name}}</div>
  @endif
  @if($user->region->name)
  Region:<div>{{$user->region->name}}</div>
  @endif
  



  <br>

  <a href={{ URL::to('users/edit/' . $user->id ) }} type="button" class="btn btn-primary" >Edit Profile</a>
 
  

   


@endsection
