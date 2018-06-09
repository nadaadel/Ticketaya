<?php

namespace App;
use App\City;
use App\Region;
use App\Ticket;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class);
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
