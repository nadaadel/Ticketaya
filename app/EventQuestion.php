<?php

namespace App;
use App\User;
use App\Event;
use Illuminate\Database\Eloquent\Relations\Pivot;


class EventQuestion extends Pivot
{
     protected $table = 'event_questions';
     protected $fillable = [
        'user_id','question','event_id','answer'
    ];

    public function getCreatedAtColumn()

    {
        return 'created_at';
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
  /*  public function user(){
        return $this->belongsTo(User::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }*/





}
