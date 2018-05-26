<?php

namespace App;
use App\Ticket;
use App\Comment;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tickets(){
        return  $this->belongsToMany(Ticket::class);
    }

}
