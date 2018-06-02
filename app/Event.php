<?php

namespace App;
<<<<<<< HEAD
use App\User;
use App\EventQuestion;

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

}
=======

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
}
>>>>>>> 349528bfe525eb92a3c956ad1e890a4fd2ce3ba1
