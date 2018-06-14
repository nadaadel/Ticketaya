{{-- <script src="{{ asset('assets/js/lib/jquery/jquery.min.js') }}"></script> --}}
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

    $('.answer-submit').on('click',function(){
     var quesId=$(this).attr('question-id');
     var question=$(this).attr('question');
     var questioner=$(this).attr('questioner');
      var body=$('#'+quesId).val();

      var event_id = $('#event_id').val();
     /* console.log(question);
      console.log(event_id);
      console.log(quesId);
      console.log(questioner);*/


      $.ajax({
            url: '/events/answer/'+event_id+'/'+user_id,
               type: 'GET' ,
               data:{
                '_token':'@csrf',
                'question':question,
                'event_id':event_id,
                'user_id':questioner,
                'answer':body,
                'quesId':quesId,
                },
                success:function(response){

                  console.log(response);
                 // $( "<div class='answer'>Answer:<p class='event-body'>"+response.answer.answer+"</p></div><hr>" ).prependTo('#'+quesId);


                }

        })
})
$('#showModel').on('click' , function(){
        $('.info-area').show();
        $(this).hide();
    });


  $('#info-submit').on('click' , function(event){
      event.preventDefault();
       var description = $('.info-body').val();
       console.log(description);
       var event_id = $('#event_id').val();
       console.log(event_id);
       $.ajax({
           url: '/events/info/new/'+event_id,
           type:'POST',
           data:{
               '_token': '{{csrf_token()}}',
               'description':description
           },
        success:function(response){
            if(response.status == 'success'){
                $( "<div id='event-info'><p class='event-time'>about minute ago</p></div>" ).prependTo(".info-parent" );
                $( "<div id='event-info'><p class='event-body'>"+description+"</p></div>" ).prependTo(".info-parent" );
                $('.info-area').hide();
                $('#showModel').show();
            }else{
             alert('error');
            }

        }
       })
    });

});


</script>

