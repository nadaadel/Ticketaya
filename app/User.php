<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Ticket;
use App\RequestedTicket;
use Actuallymab\LaravelComment\CanComment;



class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','region','city'
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
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function requestedTicket(){
       return  $this->belongsToMany('App\Ticket' , 'requested_tickets')->withPivot('requester_id' ,'quantity', 'is_accepted')->using('App\RequestedTicket');
    }

    public function soldTickets(){
        return  $this->belongsToMany('App\Ticket' , 'sold_tickets')->withPivot( 'buyer_id' , 'quantity');
     }
}
