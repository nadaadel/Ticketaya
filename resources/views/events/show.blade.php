@extends('layouts.app')
@section('content')
<fieldset>
    <legend style="background-color: gray">Event Info </legend>
    <img src="{{ asset('storage/images/events/'. $event->photo) }}" style="width:150px; height:150px;">
    <p>Name : {{ $event->name }}</p>
    <p>Avaliable tickets:{{ $event->avaliabletickets }}</p>
    <p>Description:{{ $event->description }}</p>
    <p>Start Date :{{ $event->startdate }}</p>
    <p>End Date :{{ $event->enddate }}</p>
    <p>Category :{{ $event->category->name }}</p>
    <p>Location:{{ $event->location }}</p>
    <p>By:{{ $event->user->name }}</p>
    <button id="subscribe" class="btn btn-primary">Subscribe</button>
<input type="hidden" id="user_id" value="{{Auth::user()->id}}">
<input type="hidden" id="event_id" value="{{$event->id}}">
   <hr>
</fieldset>
<script>
   $(document).ready(function(){
       $('#subscribe').on('click' , function(){
       {{ $event-> name}}
      @if(sizeof($subscribers) == 1)

      <button id="unsubscribe" class="btn btn-danger">unsubscribe</button>
      @else
      <button id="subscribe" class="btn btn-primary">Subscribe</button>
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
       });
//        $('#unsubscribe').on('click' , function(){
//          var user_id = $('#user_id').val();
//          var event_id = $('#event_id').val();
//          $.ajax({
//              url: '/events/unsubscribe/'+event_id+'/'+user_id,
//              type: 'GET' ,
//              data:{
//                  '_token':'@csrf'
//              },
//         success:function(response){
//             console.log(response);
//             if(response.status == 'success'){
//                 $('#unsubscribe').html('subscribe');
//                 $('#unsubscribe').attr('class' , 'btn btn-primary');
//             }
//         }
//          });
//        });
//    });

</script>
@endsection
