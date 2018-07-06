<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\ReportNotification;
use App\User;
use DB;

class ReportController extends Controller
{
    public function Report(Request $request){
        $message=$request->msg;
        $name=$request->name;
        $email=$request->email;
        $admin=DB::table('model_has_roles')->where('role_id','=',1)->first();
        $user=User::find($admin->model_id);
        
        $user->notify(new ReportNotification($name,$email,$message));
        flashy()->error('Your message is sent ,Thank You !');
        return redirect('/home');

    }
}
