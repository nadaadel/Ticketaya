<?php

namespace App\Http\Controllers;
use App\Event;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function subscribe($event_id , $user_id){
    DB::table('event_followers')->insert([
         'event_id' => $event_id,
         'user_id' => $user_id
    ]);
    
    return response()->json(['response' => 'success']);
    }
    public function delete($id){
        $event = Event::find($id);
        $event->delete();
        return redirect('/events');
    }
}
