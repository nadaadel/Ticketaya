<!DOCTYPE html>
<html lang="en">
@role('admin')
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


           
        </div>

        <!-- End Page wrapper  -->
    </div>
         @include('admin.footer')

</body>
@endrole
</html>
