<?php

namespace App;
use App\User;
use App\Ticket;
use Illuminate\Database\Eloquent\Model;

class SoldTicket extends Model
{
    protected $table = 'sold_tickets';

     public function buyer(){
         $buyer = User::find($this->buyer_id);
         return $buyer;
     }
     public function ticket(){
        $ticket = Ticket::find($this->ticket_id);
         return $ticket;
    }
}
