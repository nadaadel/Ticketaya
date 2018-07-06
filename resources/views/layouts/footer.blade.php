
<footer class="container-fluid">
    <div class="container">
        <div class="row justify-content-center pt-3 pb-4">
            <div class="col-md-12 footer-logo text-center">
                <a class="" href="{{URL::route('home')}}"><img src="{{ asset('/images/home/logo.png')}}"></a>
            </div>
            <div class="col-md-5 col-12 text-center footer-about">
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et leo in lacus sodales laoreet. Phasellus placerat elit eu ligula ullamcorper gravida.</p>-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Explore</h4>
                <ul>
                     <li class="pt-1">
                        <a class="" href="{{URL::route('home')}}">Home</a>
                    </li>
                    <li class="pt-1">
                        <a class="" href="{{URL::route('alltickets')}}">Tickets</a>
                    </li>
                    <li class="pt-1">
                        <a class="" href="{{URL::route('allevents')}}">Events</a>
                    </li>
                    <li class=" pt-1">
                        <a class="" href="{{URL::route('allarticles')}}">Blog</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Social Media</h4>
                <ul>
                    <li class="pt-1"><a href="#" ><i class="fab fa-facebook-square"></i>Facebook</a></li>
                    <li class="pt-1"><a href="#"><i class="fab fa-twitter-square"></i>Twitter</a></li>
                    <li class="pt-1"><a href="#"><i class="fab fa-instagram"></i>Instagram</a></li>
                </ul>
            </div>
            <div class="col-md-4" id="contact-us">
                <h4>Contact Us</h4>
                <form method="post" action="/reports" enctype="multipart/form-data">
                  {{method_field('POST')}}
                  {{csrf_field()}}
                    <input type="text" name="name" class="form-control" placeholder="Your Name Here..." required>
                    <input type="email" name="email"  class="form-control"  placeholder="Your email Here..." required>
                    <textarea placeholder="Your Message Here..." class="form-control" name="msg" required></textarea>
                    <input type="submit" class="btn btn-outline-primary">
                </form>
            </div>
        </div>

        <div class="row justify-content-center ">
            <div class="col-md-8 cpy-right">
                <p class="">All Rights Reserved for ITI Students Intake 38 - 2018</p>
            </div>
        </div>
    </div>



</footer>
