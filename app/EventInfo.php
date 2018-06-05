<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class EventInfo extends Model
{
    protected $fillable = ['event_id' , 'body' ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
