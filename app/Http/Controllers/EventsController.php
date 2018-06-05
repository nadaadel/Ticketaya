<?php

namespace App\Http\Controllers;
use App\Event;
use App\Category;
use Auth;
use DB;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function show($id){
        $event = Event::find($id);
        $subscribers = DB::table('event_user')->where('event_id' ,'=' , $id)
        ->where('user_id' , '=' , Auth::user()->id)->get();
       
        return view('events.show' , compact('event' , 'subscribers'));
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

    public function index(){
        $events=Event::all();
        return view('events.index',compact('events'));
    }

    public function create(){
        $categories=Category::all();
        return view('events.create',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:4|max:200',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'startdate' => 'required|date|before_or_equal:enddate',
            'enddate'  => 'required|date|date_format:Y-m-d|after_or_equal:startdate',
        ]);
        $event=new Event;
        if($request->hasFile('photo')){
            $request->file('photo')->store('public/images/events');
            $file_name = $request->file('photo')->hashName();
            $event->photo= $file_name;
        }
        $event->name = $request->name;
        $event->description=$request->description;
        $event->user_id= Auth::user()->id;
        $event->location=$request->location;
        $event->startdate=$request->startdate;
        $event->enddate=$request->enddate;
        $event->category_id=$request->category;
        $event->avaliabletickets=$request->avaliabletickets;
        $event->save();
       return redirect('events');
    }

    public function delete($id){
        $event = Event::find($id);
        $event->delete();
        return redirect('/events');
    }
}
