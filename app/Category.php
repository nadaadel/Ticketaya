<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use App\Event;
use App\Article;


class Category extends Model
{
    protected $fillable = ['name' ,'photo'];
    public function tickets(){
        return $this->hasMany(Ticket::Class);
    }

    public function articles(){
        return $this->hasMany(Article::Class);
    }
    public function events(){
        return $this->hasMany(Event::Class);
    }
}
