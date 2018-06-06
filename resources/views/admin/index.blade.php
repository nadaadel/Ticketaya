<!DOCTYPE html>
<html lang="en">

@include('admin.header')
<body class="fix-header fix-sidebar">

    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">

         @include('admin.admin-navbar')
         @include('admin.leftside')
        <!-- Page wrapper  -->
        <div class="page-wrapper">

            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->

            <!-- Container fluid  -->
            <div class="container-fluid">
               @yield('content')
            </div>
            <!-- End Container fluid  -->

            
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved. </footer>
            <!-- End footer -->
        </div>

        <!-- End Page wrapper  -->
    </div>
<<<<<<< HEAD

    <script src="{{ asset('assets/js/lib/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->

    <script src="{{ asset('assets/js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->


    <!-- Amchart -->
     <script src="{{ asset('assets/js/lib/morris-chart/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/morris-chart/morris.js') }}"></script>
    <script src="{{ asset('assets/js/lib/morris-chart/dashboard1-init.js') }}"></script>
	<script src="{{ asset('assets/js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <!-- scripit init-->
    <script src="{{ asset('assets/js/lib/calendar-2/semantic.ui.min.js') }}"></script>
    <!-- scripit init-->
    <script src="{{ asset('assets/js/lib/calendar-2/prism.min.js') }}"></script>
    <!-- scripit init-->
    <script src="{{ asset('assets/js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <!-- scripit init-->
    <script src="{{ asset('assets/js/lib/calendar-2/pignose.init.js') }}"></script>

    <script src="{{ asset('assets/js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/owl-carousel/owl.carousel-init.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.js') }}"></script>
=======
         @include('admin.footer')
>>>>>>> 857fe1451b2ae756829a422451db5b99c20c15ee

</body>
</html>
