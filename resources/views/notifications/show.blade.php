@extends('layouts.app')
@section('content')

<section>
    <div class="container">
        <div class="row mt-4 justify-content-center">
           @foreach($userNotifications as $notification)
            <div class="col-md-10 notify-list">
              @if($notification->notify_type_id == 1)
               <a href="/tickets/requests" class="notify-click">
              @else
              @if($notification->notify_type_id == 2)
               <a href="/events/{{$notification->related_id}}" class="notify-click">
                @endif
            @endif
                   <h3>Notification No. {{ $notification->id }}</h3>
                    <p><span> message </span> {{ $notification->message }}</p>
                    <p class="date"><span> Posted at </span> {{ $notification->created_at }}</p>
               </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
