<?php

namespace App;
use App\User;
use App\Event;

use Illuminate\Database\Eloquent\Relations\Pivot;


class EventQuestion extends Pivot
{
     protected $table = 'event_questions';
     protected $fillable = [
        'user_id','question','event_id' , 'answer'
    ];

}
