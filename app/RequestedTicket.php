<?php

namespace App;
use App\User;
use App\Ticket;
use Illuminate\Database\Eloquent\Relations\Pivot;


class RequestedTicket extends Pivot
{
    // protected $table = 'ticket_user';

    // public function users(){
    //     return $this->hasMany(User::class);
    // }

    // public function requestedTicket(){
    //     return $this->hasMany(Ticket::class);
    // }
}
