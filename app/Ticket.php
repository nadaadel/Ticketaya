<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Comment;
use App\User;
use App\RequestedTicket;
use App\Category;
use Actuallymab\LaravelComment\Commentable;

class Ticket extends Model
{

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }


    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function requestedTicket(){
       return  $this->belongsToMany(User::class , 'requested_tickets')->using('App\RequestedTicket');
    }
    public function soldTickets(){
       return  $this->belongsToMany(User::class , 'sold_tickets');
    }
}
