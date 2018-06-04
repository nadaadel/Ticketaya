<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;


class NotificationsController extends Controller
{

   /* public $pusher;

    public function __construct ()
    {
        $this->pusher = new Pusher(\Config::get('pusher.connections.main.auth_key'), \Config::get('pusher.connections.main.secret'), \Config::get('pusher.connections.main.app_id'));
    }
    public function auth (Request $request)
    {
        $user = Auth::user();
        if (Auth::check()) {
//              $presence_data = array ('name' => $user->name . " " . $user->family);

            return $this->pusher->socket_auth($request->get('channel_name'), $request->get('socket_id'));
        } else {
            return Response::make('Forbidden', 403);
        }
    }*/
    public function show(){
        $user=Auth::user();
        $userNotifications=$user->notifications;
        $unseenUserNotifications=$userNotifications->where('is_seen','=',0);
        foreach($unseenUserNotifications as $userNotification){
            $userNotification->is_seen= 1;
            $userNotification->save();
        }
        return view('notifications.show',compact('userNotifications'));
    }

    public function updateAllRead(){
        $user=Auth::user();
        $userNotifications=$user->notifications->where('is_seen','=',0);
        foreach($userNotifications as $userNotification){
            $userNotification->is_seen= 1;
            $userNotification->save();
        }
        return response()->json(['res' => 'success']);
    }

    public function edit($id){
        $notification=Notification::find($id);
        if($notification->is_seen==0){
        $notification->is_seen=1;
        $notification->save();
        return response()->json(['res' => 'unseen']);
        }
        else
        return response()->json(['res' => 'seen']);
    }






}
