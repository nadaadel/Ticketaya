<footer class="container-fluid">
    <div class="container">
        <div class="row justify-content-center pt-3">
            <div class="col-md-12 footer-logo text-center">
                <a class="" href="{{URL::route('home')}}"><img src="{{ asset('/images/home/logo.png')}}"></a>
            </div>
            <div class="col-md-5 col-12 text-center footer-about">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et leo in lacus sodales laoreet. Phasellus placerat elit eu ligula ullamcorper gravida.</p>
            </div>
        </div>
        <div class="row justify-content-center pt-3 ">
            <div class="col-md-8 footer-nav  social text-center">
                <ul>
                     <li class="pt-2">
                        <a class="nav-link" href="{{URL::route('home')}}">HOME</a>
                    </li>
                    <li class="nav-item active pt-2">
                        <a class="nav-link" href="{{URL::route('alltickets')}}">TICKETS</a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link" href="{{URL::route('allevents')}}">EVENTS</a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link " href="{{URL::route('allarticles')}}">BLOG</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center pt-3 ">
            <div class="col-md-8 social text-center">
                <ul>
                    <li><i class="fab fa-facebook-square"></i></li>
                    <li><i class="fab fa-twitter-square"></i></li>
                    <li><i class="fab fa-instagram"></i></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-md-8 cpy-right">
                <p class="">All Rights Reserved for ITI Students Intake 38 - 2018</p>
            </div>
        </div>
    </div>
</footer>

