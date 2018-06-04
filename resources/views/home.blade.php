@extends('layouts.app')


@section('content')
<section>

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
<!-- main header in home page -->
        <section id="hero-home">
            <div class='slider'>
                <div class="overlay"></div>
                <div class='slide1'></div>
                <div class='slide2'></div>
                <div class='slide3'></div>
                <div class="content d-flex align-items-center">
                    <div class="container ">
                        <div class="row auto">
                          <div class="col-md-6 offset-md-3 text-center">
                            <h1>Tickets to Anywhere <br>
                                Here you will Find It</h1>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                   suffered alteration in some form, by injected humour,
                                   or randomised words which don't look even slightly believable.</p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 offset-md-3 text-center">
                          <form method="POST" action="/tickets/search" enctype="multipart/form-data">
                              {{ csrf_field() }}
                            <input class="search" type="search" placeholder="Search Tickets, events or more..." aria-label="Search" name="search"> 
                            <button class="btn btn btn-outline-primary search-btn" type="submit">Search</button>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
              </div>

        </section> <!-- End of header in home page -->
        <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->


    <!-- <div class="row justify-content-center">
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
    </div> -->
  </section>
@endsection
