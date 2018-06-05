@extends('layouts.app')
@section('content')

     {{ $event-> name}} EVENT <br>
    @if(Auth::user()->id == $event->user_id)
     <button id="showModel" class="btn btn-primary"> Add New Info </button>
     <div class="info-area" style="display:none;">
            <textarea class="info-body" cols="9">

            </textarea>
            <button id="info-submit" class="btn btn-info">Post</button>
     </div>
    @endif
  <div class="info-parent">
        @foreach ($eventInfos as $info )
        <div class="event-info" style="display:block;">
            <p class="event-body">{{$info->body}} <p>
            <p class="event-time">{{$info->created_at->diffForHumans()}} <p>

        <div>
       @endforeach
  </div>

    @if(Auth::user()->id != $event->user_id)
      @if(sizeof($subscribers) == 1)

      <button id="unsubscribe" class="btn btn-danger">unsubscribe</button>
      @else
      <button id="subscribe" class="btn btn-primary">Subscribe</button>
      @endif
    @endif
<input type="hidden" id="user_id" value="{{Auth::user()->id}}">
<input type="hidden" id="event_id" value="{{$event->id}}">
<script>
    $(document).ready(function(){
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
            if(response.status == 'success'){
                $('#subscribe').html('unsubscribe');
                console.log('success');
                $('#subscribe').attr('class' , 'btn btn-danger');
            }
        }
         });
       })
    $('#showModel').on('click' , function(){
        $('.info-area').show();
        $(this).hide();
    });

    $('#info-submit').on('click' , function(){
       var description = $('.info-body').val();
       console.log(description);
       var event_id = $('#event_id').val();
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
@endsection
