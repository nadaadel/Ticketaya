<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use App\Event;

class Category extends Model
{
    protected $fillable = ['name'];
    public function tickets(){
        return $this->hasMany(Ticket::Class);
    }

    public function events(){
        return $this->hasMany(Event::Class);
    }
}
