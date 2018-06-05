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
    protected $fillable = [
        'name', 'photo', 'description','price','region','city',
        'quantity','is_sold','type','expire_date'
    ];
    public function savedBy()
    {
       return $this->belongsToMany(User::class,'saved_tickets_users','ticket_id','user_id');
    }

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
        return $this->belongsToMany(Tag::class, 'ticket_tags','ticket_id', 'tag_id');
    }

    public function requestedTicket(){
       return  $this->belongsToMany(User::class , 'requested_tickets')->using('App\RequestedTicket');
    }
    public function soldTickets(){
       return  $this->belongsToMany(User::class , 'sold_tickets');
    }
}
