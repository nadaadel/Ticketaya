        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light bg-dark">
                <!-- Logo -->
                <div class="navbar">
                        <!-- Logo icon -->
                        <a class="navbar-brand" href="{{URL::route('home')}}">
                                <img src="{{ asset('/images/home/logo.png')}}"  width="120 px" />
                        </a>
                        {{-- <img src="/images/home/logo.png"  width="100 px" /> --}}
                        <!--End Logo icon -->
                        <!-- Logo text -->
                            </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Comment -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell"></i>
								<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
							</a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center" id="dropdownmenu">
                                            <!-- Message -->
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="/notifications"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Comment -->
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('storage/images/users/'.Auth::user()->avatar) }}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="{{route('showuser', ['id' => Auth::id()])}}"><i class="ti-user"></i> Profile</a></li>
                                    {{-- <li><a href="#"><i class="ti-wallet"></i> Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li> --}}
                                    <li><a href="/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->

    @if(Auth::check())
    <script type="text/javascript">
    $(function () {
      var oldNotifications = {!! json_encode(Auth::user()->notifications->toArray()) !!};
      Pusher.logToConsole = true;
      //** don't forget to change this **//
      var pusher = new Pusher('0fe1c9173ec82e038dd5', {
        encrypted: true,
        cluster:"eu"
      });


    function notificationsHtml(data,realtime){
              var existingNotifications = $('#dropdownmenu').html();
              var url ="";
              if(data.notify_type_id == 1){
                  url="/tickets/"+data.related_id;

              }
              else if(data.notify_type_id == 2){
                  url="/events/"+data.related_id;
              }
              if(realtime){
              console.log(data)
                    notificationsCount += 1;
                    data.created_at=new Date(Date.now());
                    data.is_seen=0;
                    data.id=data.notification_id;

              }
              var newNotificationHtml = `<div class="mail-contnet">
              <a notif-no="`+data.id+`" url="`+url+`" class="notify-seen" style="cursor: pointer;">
              <strong style="color:black;" class="notification-title">`+data.message+`</strong>
              <span class="time"> `+data.created_at+`</span></a>
              </div>`;
            $('#dropdownmenu').html(newNotificationHtml + existingNotifications);

      }
      function bindChannel(channel,event) {
          channel.bind(event , function(notify){
              console.log(notify);
            notificationsHtml(notify,1);
            console.log(notify.is_accept)
            if(notify.is_accept == true){
                $('#edit').hide();
                $('#loginuser').hide();

            }
            else{
            $('#edit').hide();
            $('#loginuser').hide();
            $('#RequestTicket').show();

            }

            });
    }
      $.each(oldNotifications.reverse(), function( i, val) {
        notificationsHtml(val,0);
    });

        // change notifications status that was unseen to be seen
        $(document).on('click','.notify-seen',function(){
            var notif_id=$(this).attr('notif-no');
            var gotoURL=$(this).attr('url');
                    $.ajax({
                        type: 'get',
                        url: '/notifications/'+notif_id+'/edit',
                        data:{
                        '_token':'{{csrf_token()}}',
                        },
                        success: function (response) {
                            window.location = gotoURL;

                        }

                });
           });
    var ticketRequestChannel = pusher.subscribe('ticket-requested_{{ Auth::user()->id }}');
    bindChannel(ticketRequestChannel,'App\\Events\\TicketRequested');
    var ticketReceivedChannel= pusher.subscribe('ticket-received_{{ Auth::user()->id }}');
    bindChannel(ticketReceivedChannel,'App\\Events\\TicketReceived');
    var statusTicketrequested=pusher.subscribe('status-tickedrequest_{{ Auth::user()->id }}');
    bindChannel(statusTicketrequested,'App\\Events\\StatusTicketRequested');

    var eventSubscribersChannel = pusher.subscribe('event-subscriber_{{ Auth::user()->id }}');
    bindChannel(eventSubscribersChannel,'App\\Events\\EventSubscribers');

    var questionNotification=pusher.subscribe('question-notification_{{ Auth::user()->id }}');
    bindChannel(questionNotification,'App\\Events\\Question');

    var answerNotification=pusher.subscribe('answer-notification_{{ Auth::user()->id }}');
    bindChannel(answerNotification,'App\\Events\\Answer');
    });

    </script>
    @endif
