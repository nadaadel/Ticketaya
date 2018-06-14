<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use App\User;
use App\NotifyType;
use Carbon\Carbon;

class Notification extends Model
{
    protected $fillable = ['message','user_id','notify_type_id','related_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }


    public function type(){
        return $this->belongsTo(NotifyType::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
}
