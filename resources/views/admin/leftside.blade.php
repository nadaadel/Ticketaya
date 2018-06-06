 <!-- Left Sidebar  -->
 <div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
            <li> <a  href="{{URL::route('admin-index')}}" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                <li> <a class="has-arrow" href="{{URL::route('alltickets')}}" aria-expanded="false"><i class="fa fa-credit-card"></i><span class="hide-menu">Tickets </span></a>
                <li> <a class="has-arrow" href="{{URL::route('allevents')}}" aria-expanded="false"><i class="fa fa-bomb"></i><span class="hide-menu">Events </span></a>
                <li> <a class="has-arrow" href="{{URL::route('allusers')}}" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Users</span></a>
                <li> <a class="has-arrow" href="{{URL::route('alltags')}}" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu">Tags</span></a>
                <li> <a  href="{{URL::route('allcategories')}}" aria-expanded="false"><i class="	fa fa-cube"></i><span class="hide-menu">Categories</span></a>

                </li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="hide-menu">Charts</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="chart-flot.html">Flot</a></li>
                        <li><a href="chart-morris.html">Morris</a></li>
                        <li><a href="chart-chartjs.html">ChartJs</a></li>
                        <li><a href="chart-chartist.html">Chartist </a></li>
                        <li><a href="chart-amchart.html">AmChart</a></li>
                        <li><a href="chart-echart.html">EChart</a></li>
                        <li><a href="chart-sparkline.html">Sparkline</a></li>
                        <li><a href="chart-peity.html">Peity</a></li>
                    </ul>
                </li>
                <li class="nav-label">FEATURE</li>

                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-map-marker"></i><span class="hide-menu">Maps</span></a>
                    <ul aria-expanded="false" class="collapse">
                    <li><a href="{{URL::route('eventslocation')}}">Events</a></li>
                        <li><a href="map-vector.html">Tickets</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-level-down"></i><span class="hide-menu">Multi level dd</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">item 1.1</a></li>
                        <li><a href="#">item 1.2</a></li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false">Menu 1.3</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#">item 1.3.1</a></li>
                                <li><a href="#">item 1.3.2</a></li>
                                <li><a href="#">item 1.3.3</a></li>
                                <li><a href="#">item 1.3.4</a></li>
                            </ul>
                        </li>
                        <li><a href="#">item 1.4</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->
