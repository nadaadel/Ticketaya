<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Ticket;
use App\RequestedTicket;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tickets(){
        return  $this->hasMany(Ticket::class);
    }

    public function requestedTicket(){
       return  $this->belongsToMany('App\Ticket' , 'requested_tickets')->withPivot('requester_id' ,'quantity', 'is_accepted')->using('App\RequestedTicket');
    }

    public function soldTickets(){
        return  $this->belongsToMany('App\Ticket' , 'sold_tickets')->withPivot( 'buyer_id' , 'quantity');
     }
}
