<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Ticket;

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
    
/*public function tickets()
    {
      return $this->belongsToMany(Ticket::class);
    }
*/
    public function requests(){
        $this->belongsToMany('App\Ticket' , 'requested_tickets' ,'name' , 'id' , 'city');
    }

}
