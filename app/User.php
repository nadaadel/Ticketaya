<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Ticket;
use App\RequestedTicket;
use App\Event;
use App\EventQuestion;
use Actuallymab\LaravelComment\CanComment;
use App\City;
use App\Region;



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


     public function notifications(){
        return $this->hasMany(Notification::class)->orderBy('id', 'desc');
    }

    public function events(){
        return $this->hasMany(Event::class);
    }
    public function favouriteEvents(){

        return $this->belongsToMnay('App\Event','event_user')->withPivot('is_follower','is_saver');
    }

    public function eventquestions(){
        return $this->hasMany(EventQuestion::class);
    }

    public function savedTickets()
    {
       return $this->belongsToMany(Ticket::class,'saved_tickets_users','user_id','ticket_id');
    }
    public function spammedTickets(){
        return  $this->belongsToMany(Ticket::class , 'spam_tickets');
     }
     public function City(){
        return $this->belongsTo(City::class);
    }
    public function Region(){
        return $this->belongsTo(Region::class);
    }

}
