<?php

namespace App;
use App\Ticket;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
