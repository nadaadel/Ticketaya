<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;

class Category extends Model
{
    public function tickets(){
        return $this->hasMany(Ticket::Class);
    }
}
