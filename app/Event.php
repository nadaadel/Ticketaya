<?php

namespace App;
use App\User;
use App\EventQuestion;
use App\EventInfo;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = [
        'name','user_id','photo','location','startdate','shortdate','category','avaliableticket','description'

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMnay('App\User','event_user')->withPivot('is_follower','is_saver');
    }
    public function eventquestions(){
        return $this->hasMany(EventQuestion::class);

    }
    public function eventInfo(){
        return $this->hasMany(EventInfo::class);
    }

}

