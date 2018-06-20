 <!-- Left Sidebar  -->
 <div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
            <li> <a  href="{{URL::route('admin-index')}}" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a></li>
                <li> <a class="has-arrow" href="{{URL::route('alltickets')}}" aria-expanded="false"><i class="fa fa-credit-card"></i><span class="hide-menu">Tickets </span></a></li>
                <li> <a class="has-arrow" href="{{URL::route('requestedtickets')}}" aria-expanded="false"><i class="fa fa-credit-card"></i><span class="hide-menu">Requested Tickets </span></a></li>
                <li> <a class="has-arrow" href="{{URL::route('soldtickets')}}" aria-expanded="false"><i class="fa fa-credit-card"></i><span class="hide-menu">Sold Tickets </span></a></li>
                <li> <a class="has-arrow" href="{{URL::route('showSavedTickets')}}" aria-expanded="false"><i class='fas fa-heart heart'></i><span class="hide-menu">Saved Tickets </span></a></li>

                <li> <a class="has-arrow" href="{{URL::route('allevents')}}" aria-expanded="false"><i class="fa fa-bomb"></i><span class="hide-menu">Events </span></a></li>
                <li> <a class="has-arrow" href="{{URL::route('allusers')}}" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Users</span></a></li>
                <li> <a class="has-arrow" href="{{URL::route('alltags')}}" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu">Tags</span></a></li>
                <li> <a  href="{{URL::route('allcategories')}}" aria-expanded="false"><i class="fa fa-cube"></i><span class="hide-menu">Categories</span></a></li>
                <li> <a  href="{{URL::route('allarticles')}}" aria-expanded="false"><i class="f	fa fa-book"></i><span class="hide-menu">Articles</span></a></li>

                <li> <a  href="{{URL::route('eventslocation')}}" aria-expanded="false"><i class="fa fa-map-marker"></i><span class="hide-menu">Events Locations</span></a></li>
                <li> <a  href="{{URL::route('ticketslocation')}}" aria-expanded="false"><i class="fa fa-map-marker"></i><span class="hide-menu">Tickets Locations</span></a></li>
                </li>

                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->
