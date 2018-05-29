<?php

namespace App;
use App\User;
use App\Ticket;
use Illuminate\Database\Eloquent\Model;

class SoldTicket extends Model
{
    protected $table = 'sold_tickets';
    protected $fillable = ['ticket_id' , 'user_id' , 'buyer_id' , 'quantity'];

     public function buyer(){
         $buyer = User::find($this->buyer_id);
         return $buyer;
     }
     public function ticket(){
        $ticket = Ticket::find($this->ticket_id);
         return $ticket;
    }
}
