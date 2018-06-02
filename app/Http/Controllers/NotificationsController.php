<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;


class NotificationsController extends Controller
{
    
    public $pusher;

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
    }

    




}