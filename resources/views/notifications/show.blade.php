@extends('layouts.app')
@section('content')
@foreach($userNotifications as $notification)
       <fieldset>
                    <legend style="background-color: gray">No. {{ $notification->id }} </legend>
           <a href="#" ><p>message : {{ $notification->message }}</p></a>
                    <h5>at:{{ $notification->created_at }}</h5>
                   <hr>
                </fieldset>
    @endforeach

@endsection
