<script src="{{ asset('assets/js/lib/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
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
<script>
$(document).ready(function(){
    $('#city').on('change',function(){
        var cityId=$(this).val();
        $('#region').empty();
        console.log(cityId)
        $.ajax({
            url: '/cities/'+cityId,
            type: 'GET' ,
            data:{
                 '_token':'@csrf'
             },
            success:function(response){
                if(response.res == 'success'){
                $.each(response.cityRegions, function(index,region){
                var option=`<option value="`+region.id+`">`+region.name+`</option>`;
                $('#region').append(option);
            });
            $('#toggleRegion').show();
            }

             }
        })
      

    });
});


</script>

