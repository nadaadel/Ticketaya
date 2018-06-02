<button id="subscribe" class="btn btn-primary">Subscribe</button>
<input type="hidden" id="user_id" value="{{Auth::user()->id}}">
<input type="hidden" id="event_id" value="{{$event->id}}">

<script>
   $(document).ready(){
       $('#subscribe').on('click' , function(){
         var user_id = $('#user_id').val();
         var event_id = $('#event_id').val();
         $.ajax({
             url: '/events/subscribe/'+event_id+'/'+user_id,
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            console.log(response);
            if(response == 'success'){
                $('#subscribe').html('subscribed');
            }
        }
         })



       })
   }

</script>
