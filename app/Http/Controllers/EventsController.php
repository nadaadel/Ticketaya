<?php

namespace App\Http\Controllers;
use App\Event;
use App\EventInfo;

use DB;
use Auth;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function show($id){
        $event = Event::find($id);
        $subscribers = DB::table('event_user')->where('event_id' ,'=' , $id)
        ->where('user_id' , '=' , Auth::user()->id)->get();
        $eventInfos = EventInfo::where('event_id','=',$event->id)->orderBy('created_at', 'desc')->get();
        return view('events.show' , compact('event' , 'subscribers' ,'eventInfos'));
    }

    public function subscribe($event_id , $user_id){
    DB::table('event_user')->insert([
         'event_id' => $event_id,
         'user_id' => $user_id
    ]);

    return response()->json(['status' => 'success']);

    }
    // public function unsubscribe($event_id , $user_id){

    //     $unsubscribe = DB::table('event_user')->where('event_id' , '=' ,$event_id)
    //     ->where('user_id' , '=', $user_id)->get();
    //     $unsubscribe->pivot->delete();
    //     return response()->json(['status' => 'success']);

    //     }

    public function newInfo($event_id , Request $request){
      EventInfo::create([
         'event_id' => $event_id,
         'body' => $request->description
      ]);
      //fire Notification Here
      return response()->json(['status' => 'success']);

    }
    public function delete($id){
        $event = Event::find($id);
        $event->delete();
        return redirect('/events');
    }
}
