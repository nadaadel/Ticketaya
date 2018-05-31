@extends('layouts.app')

@section('content')
<div class="container">

        <script type="text/javascript">
        // notification for status liked
          var notificationsWrapper   = $('.dropdown-notifications');
          var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
          var notificationsCountElem = notificationsToggle.find('i[data-count]');
          var notificationsCount     = parseInt(notificationsCountElem.data('count'));
          var notifications          = notificationsWrapper.find('ul.dropdown-menu');

          // Enable pusher logging - don't include this in production
          Pusher.logToConsole = true;

          var pusher = new Pusher('6042cdb1e9ffa998e5be', {
            encrypted: true,
            cluster:"mt1"
          });

          // Subscribe to the channel we specified in our Laravel Event
          var channel = pusher.subscribe('status-liked');
          var ticketRequestChannel = pusher.subscribe('ticket-requested');
          ticketRequestChannel.bind('App\\Events\\TicketRequested' , function(data){
              var existingNotifications = notifications.html();
              var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
              var newNotificationHtml = `
              <li class="notification active">
                  <div class="media">
                    <div class="media-left">
                      <div class="media-object">
                        <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                      </div>
                    </div>
                    <div class="media-body">
                      <strong class="notification-title">`+data.message+`</strong>
                      <!--p class="notification-desc">Extra description can go here</p-->
                      <div class="notification-meta">
                        <small class="timestamp">about a minute ago</small>
                      </div>
                    </div>
                  </div>
              </li>
            `;
            notifications.html(newNotificationHtml + existingNotifications);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
            console.log(data.message);
          });



          // Bind a function to a Event (the full Laravel class)
          channel.bind('App\\Events\\StatusLiked', function(data) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `
              <li class="notification active">
                  <div class="media">
                    <div class="media-left">
                      <div class="media-object">
                        <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                      </div>
                    </div>
                    <div class="media-body">
                      <strong class="notification-title">`+data.message+`</strong>
                      <!--p class="notification-desc">Extra description can go here</p-->
                      <div class="notification-meta">
                        <small class="timestamp">about a minute ago</small>
                      </div>
                    </div>
                  </div>
              </li>
            `;
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
          });
        </script>

        <div class="jumbotron">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <a class="btn btn-outline-success my-2 my-sm-0"  href={{ URL::to('tickets/search ') }} type="submit">Search</a>
        </div>




    <div class="row justify-content-center">
    @role('admin')
    <a href="/admin"  type="button" class="btn btn-default" >Admin Panel</a>
     @endrole
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

