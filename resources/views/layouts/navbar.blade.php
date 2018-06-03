<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tickets">Tickets</a>
      </li>
      <li class="nav-item">
            <a class="nav-link" href="/events">Events</a>
          </li>
    </ul>
  </div>
  @if (Auth::check())
  <input id="user_id" type="hidden" value="{{Auth::user()->id}}">
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="dropdown dropdown-notifications">
        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
          <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
        </a>

        <div class="dropdown-container">
          <div class="dropdown-toolbar">
            <div class="dropdown-toolbar-actions">
              <a href="#">Mark all as read</a>
            </div>
            <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
          </div>
          <ul class="dropdown-menu">
          </ul>
          <div class="dropdown-footer text-center">
            <a href="/tickets/requests">View All</a>
          </div>
        </div>
      </li>
    </ul>
  </div>

  <script type="text/javascript">
    // notification for status liked
      var notificationsWrapper   = $('.dropdown-notifications');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = notificationsToggle.find('i[data-count]');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = notificationsWrapper.find('ul.dropdown-menu');

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('7cd2d7485f85e6da6263', {
        encrypted: true,
        cluster:"mt1"
      });

      var user_id = $('#user_id').val()
      // Subscribe to the channel we specified in our Laravel Event
      var ticketRequestChannel = pusher.subscribe('ticket-requested_{{ Auth::user()->id }}');
      var statusTicketrequested=pusher.subscribe('status-tickedrequest_{{ Auth::user()->id }}')
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
                 <a href="/tickets/requests"><strong style="color:black;" class="notification-title">`+data.message+`</strong></a>
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
      //for accept ticket notification
      statusTicketrequested.bind('App\\Events\\StatusTicketRequested' , function(data){
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
                 <a href="/tickets/requests"><strong style="color:black;" class="notification-title">`+data.message+`</strong></a>
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

    </script>
  @else
  //show logged out navbar

@endif

</div>
</nav>
