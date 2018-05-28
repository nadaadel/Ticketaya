<?php

namespace App;
use App\User;
use App\Ticket;
use Illuminate\Database\Eloquent\Relations\Pivot;


class RequestedTicket extends Pivot
{
     protected $table = 'requested_tickets';

     public function requested_user(){
         $request_user = User::find($this->requester_id);
         return $request_user;
     }
     public function ticket(){
        $ticket = Ticket::find($this->ticket_id);
         return $ticket;
    }

}
