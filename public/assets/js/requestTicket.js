$(document).ready( function(){
    $('#want').on('click' , function(){
            var quantity = $('#quantity').val();
            console.log(quantity);

            var ticket_id = $('#ticket-id').val();
            console.log(quantity);
            $.ajax({
                url: '/tickets/request/'+ticket_id,
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    'quantity':quantity
                },
                success:function(response){
                    console.log(response.response)
                   if(response.response =='ok'){
                    console.log(response.response);
                    alert('Ticket Requested Successfully');
                    $('.requestticket').hide();
                    $('#loginuser').show();

                   }
                   else{
                    console.log(response);
                    alert('You Cant request this ticket ,Your quantity must be >'+response.quantity+' and >0');
                   }
                }
            });

 });


 $('#editshow').on('click' , function(){
        $('#editrequest').show();
        $(this).hide();
 });

 $('#editticket').on('click' , function(){
            var quantity  = $('#editquantity').val();
            var ticket_id = $('#edit-ticket-id').val();
            $.ajax({
                url: '/tickets/request/edit/'+ticket_id,
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    'quantity':quantity,
                    'ticket_id':ticket_id ,
                },
                success:function(response){
                    //console.log(response.response)
                   if(response.response =='ok'){
                   // console.log(response.response);
                    console.log(response.ticket )

                    alert('Edit Requested Successfully');
                   }
                   else{
                    console.log(response);
                   alert('You Cant edit requested ticket ,Your quantity must be >'+response.quantity+'and >0');
                   }
                }
            });
 });
$('.reply').on('click',function(){

    var elem = this;
    var ticketId=$(this).attr("ticket-no");
    var commentId=$(this).attr("comment-id");
    $.ajax({
            url: '/replies/'+commentId,
            type: 'GET',
            data: {
                '_token':'{{csrf_token()}}',
                 },
            success: function (response) {
            console.log(response.names);
            $('#'+commentId).show();

            for(var i=0;i<response.replies.length;i++){

               for (var j=0;j<response.names.length;j++){
                if (i==j){
                    $('#'+commentId).append('<div>'+response.names[j]+'</div>')
                    $('#'+commentId).append('<div>'+response.replies[i].body+'</div>' +'<br>')

               }

               }
            }
            }
            })
            $(this).hide();
  });
       $('#save_ticket').on('click' , function(){
           console.log($(this).html());
           if($(this).html()=='save'){
         $.ajax({
             url: '/tickets/save/{{$ticket->id}}',
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            console.log(response);
            if(response.res == 'success'){
                $('#save_ticket').html('unsave');
                $("#save_ticket").attr('class', 'btn btn-danger');
            }
        }
         });
           }
           else
           if($(this).html()=='unsave'){
            $.ajax({
             url: '/tickets/unsave/{{$ticket->id}}',
             type: 'GET' ,
             data:{
                 '_token':'@csrf'
             },
        success:function(response){
            console.log(response);
            if(response.res == 'success'){
                $('#save_ticket').html('save');
                $("#save_ticket").attr('class', 'btn btn-primary');
            }
            }
         });
        }
    });
});
