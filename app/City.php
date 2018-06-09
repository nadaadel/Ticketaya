<?php

namespace App;

use App\City;
use App\Region;
use App\Ticket;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function regions(){
        return $this->hasMany(Region::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function events(){
        return $this->hasMany(Ticket::class);
    }

}
