<?php

namespace App;
use App\Notification;
use Illuminate\Database\Eloquent\Model;

class NotifyType extends Model
{
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
