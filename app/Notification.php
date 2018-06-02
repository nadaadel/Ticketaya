<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use App\User;
use App\NotifyType;

class Notification extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }


    public function type(){
        return $this->belongsTo(NotifyType::class);
    }




}