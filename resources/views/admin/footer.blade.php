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

    $('.admin').on('click',function(){
      var elem =$(this);
      var id =$(this).attr('user-id');
      $.ajax({
            url: '/users/admin/'+id,
            type: 'GET',
            data:{
                 '_token':'@csrf'
             },
            success:function(response){
                if(response.response == 'success'){
                  $(elem).hide();

                }

            }



      })

    });
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
    $(document).on('click','.deletQues',function(){
        var question_id=$(this).attr('delete-ques');
        $.ajax({
            url: '/questions/delete/'+question_id,
            type: 'POST' ,
            data:{
                'id':question_id,
                '_token': '{{csrf_token()}}',
                '_method':'DELETE'
                },
            success:function(response){
                $('#'+question_id).remove();
            }

        })
    })

     $('.answer-submit').on('click',function(){
     var quesId=$(this).attr('question-id');
     var question=$(this).attr('question');
     var questioner=$(this).attr('questioner');
     var body=$(this).parent().find('textarea').val();
     var event_id = $('#event_id').val();
      $.ajax({
            url: '/events/answer/'+event_id+'/'+questioner,
               type: 'GET' ,
               data:{
                '_token':'@csrf',
                'question':question,
                'event_id':event_id,
                'asker_id':questioner,
                'answer':body,
                'quesId':quesId,
                },
                success:function(response){
                if(response.response== 'success'){
               $('#'+response.answer.id).find("div[my-name='answer']").html("Answer:"+response.answer.answer+"<hr>")

                }
                }

        })


  })
  $('#subscribe').on('click' , function(){

var user_id = $('#user_id').val();
var event_id = $('#event_id').val();
console.log($(this).html())
if ($(this).html()=="subscribe"){
    console.log("hiii")
    $.ajax({
      url: '/events/subscribe/'+event_id+'/'+user_id,
      type: 'GET' ,
      data:{
       '_token':'@csrf'
       },


   success:function(response){
    console.log(response);

   if(response.status == 'success'){
      $('#subscribe').html('unsubscribe');
      console.log('success');
     $('#subscribe').attr('class' , 'btn btn-danger');
    }
}



});
}
else{

$.ajax({
      url: '/events/unsubscribe/'+event_id+'/'+user_id,
      type: 'GET' ,
      data:{
       '_token':'@csrf'
       },


   success:function(response){
    console.log(response);

   if(response.status == 'success'){
      $('#subscribe').html('subscribe');
      console.log('success');
     $('#subscribe').attr('class' , 'btn btn-primary');
    }
}



});

}




});

$('#showModel').on('click' , function(){
        $('.info-area').show();
        $(this).hide();
    });


   $('#info-submit').on('click' , function(){
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
                console.log('ok')
                $( " <div class='row'><div class='col-md-8' id='"+response.id+"'></div>" ).prependTo(".info-parent" );
                $('#'+response.id).append("<h4 class='event-body'>"+description+"</h4>")
                $('#'+response.id).append( "<p class='event-time'><span>Posted at</span> "+response.time.date+"</p>" );
                $('#'+response.id).append("<div class='col-md-8'><button class='deleteinfo btn btn-danger float-right' btn-id='"+response.id+"'>Delete</button></div></div>");
                $('#'+response.id).append("<hr>");
                $('.info-area').hide();
                $('#showModel').show();
                $('.deleteinfo').on('click',function(){
        var id =$(this).attr('btn-id');
        console.log(id)
        $.ajax({
           url: '/events/info/delete/'+id,
           type:'POST',
           data:{
               '_token': '{{csrf_token()}}',
               '_method':'DELETE',

           },
        success:function(response){

            if(response.response == 'success'){
                console.log('pl')
                $('#'+id).remove();


        }
       }
        })
    })
            }else{
             alert('error');
            }

        }
       })
    });
    $('.deleteinfo').on('click',function(){
        var id =$(this).attr('btn-id');
        console.log(id)
        $.ajax({
           url: '/events/info/delete/'+id,
           type:'POST',
           data:{
               '_token': '{{csrf_token()}}',
               '_method':'DELETE',
               
           },
        success:function(response){

            if(response.response == 'success'){
                console.log('ok')
                $('#'+id).remove();
                

        }
       }
        })
    });
    $('.deletebtn').on('click',function(){
            console.log('iam here');
            var event_id = $(this).attr('event-id');
            var resp = confirm("Do you really want to delete this event?");
            if (resp == true) {
                $.ajax({
                    type: 'POST',
                    url: '/events/delete/'+event_id ,
                    data:{
                    '_token':'{{csrf_token()}}',
                    '_method':'DELETE',
                    },
                    success: function (response) {
                        if(response.response=='success'){
                          console.log('ok');
                            $('#'+event_id).remove();
                           

                        }
                    }
                });

            }
        });
    $('.deleteuser').on('click',function(){
            console.log('iam here');
            var user_id = $(this).attr('user-id');
            var resp = confirm("Do you really want to delete this user?");
            if (resp == true) {
                $.ajax({
                    type: 'POST',
                    url: '/users/'+user_id ,
                    data:{
                    '_token':'{{csrf_token()}}',
                    '_method':'DELETE',
                    },
                    success: function (response) {
                        if(response.response=='success'){
                          console.log('ok');
                            $('#'+user_id).remove();
                           

                        }
                    }
                });

            }
        });

});
$('#question-submit').on('click',function(){

var body=$('#ques-body').val();
var user_id = $('#user_id').val();
var event_id = $('#event_id').val();
var no=$('.allquestion').attr('question-no');
$('.question-area').hide();
$.ajax({
    url: '/events/question/'+event_id+'/'+user_id,
       type: 'GET' ,
       data:{
        '_token':'@csrf',
        'question':body,
        'event_id':event_id,
        'user_id':user_id,
        },
        success:function(response){
         if(response.response == 'success'){
            var question=response.questions;
            $(`<div id=`+question.id+`>
                    <button class="deletQues btn  btn-danger float-right" delete-ques=`+question.id+`>
                    delete</button>
                    Question<h4>`+question.question+`</h4>
                    Answer:
                    <hr></div>`).appendTo('.questions');
            $('#ques-body').val('');
         }
        }
});
});

</script>

