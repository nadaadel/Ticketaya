@extends('admin.index')
@section('content')
    <section class="user-profile">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <div class="user-profile-img">
                         <div style="background-image: url(../images/icons/avatar.jpg);">
                          @if($user->avatar)
                           <img src="{{ asset('storage/images/users/'. $user->avatar) }}">
                          @endif
                        </div>
                    </div>
                    <div class="user-info mt-4">
                        <h3>{{$user->name}}</h3>

                        <table>
                            <tr>
                                <td><span class="bold">Email </span></td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td><span class="bold">Phone </span></td>
                                <td>{{$user->phone}}</td>
                            </tr>
                            <tr>
                               @if($user->city)
                                <td><span class="bold">City </span></td>
                                <td> {{$user->city->name}}</td>
                                @endif
                            </tr>
                            <tr>
                               @if($user->region)
                                <td><span class="bold">Region </span></td>
                                <td>{{$user->region->name}}</td>
                                 @endif
                            </tr>

                        </table>
                    </div>
                    @if(Auth::check() && Auth::id()==$user->id || Auth::user()->hasRole('admin') )
                    <div class="mt-4">
                        <a href="{{ URL::to('users/edit/' . $user->id ) }}" class="btn btn-secondary"> Edit Profile</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
