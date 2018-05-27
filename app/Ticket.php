<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Comment;
use App\User;


class Ticket extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function requests(){
        $this->belongsToMany('App\User' , 'requested_tickets' ,'name' , 'price' , 'description');
    }
}
