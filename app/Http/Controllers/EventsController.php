<?php
namespace App\Http\Controllers;
use App\Event;
use App\EventInfo;
use DB;
use App\Category;
use Auth;
use App\User;
use App\City;
use App\Events\EventSubscribers;
use Illuminate\Http\Request;
use App\EventQuestion;

class EventsController extends Controller
{
    public function show($id){
        $event = Event::find($id);
        if(Auth::user()){
        $eventSubscibers = DB::table('event_user')->where('event_id' ,'=' , $id)->get();
        $subscribers = DB::table('event_user')->where('event_id' ,'=' , $id)
        ->where('user_id' , '=' , Auth::user()->id)->get();
        }
        $questions=EventQuestion::all()->where('event_id',$id);
        $eventInfos = EventInfo::where('event_id','=',$event->id)->orderBy('created_at', 'desc')->get();
        return view('events.show' , compact('event' , 'subscribers' ,'eventInfos','questions'));
    }
    public function storeQuestion(Request $request){
        $questionfound=EventQuestion::all()->where('question','=',$request->question)->first();
       // dd($questionfound==null);
        if (!$questionfound){

        $eventQuestion=EventQuestion::create([
            'event_id'=>$request->event_id,
            'user_id'=>$request->user_id,
            'question'=>$request->question,


        ]);
        }

        return response()->json(['questions' => $eventQuestion]);
    }
    public function updateQuestion(Request $request){
        $user = User::find($request->user_id);

        $question=$user->eventquestions()->where('question','=',$request->question)->first();
        //dd($question);
        $question->pivot->answer=$request->answer;
        $question->pivot->save();




        return response()->json(['answer' => $eventQuestion]);
    }
    public function subscribe($event_id , $user_id){
    DB::table('event_user')->insert([
         'event_id' => $event_id,
         'user_id' => $user_id
    ]);
    return response()->json(['status' => 'success']);

    }
    public function unsubscribe($event_id ){
        $subscriber =DB::table('event_user')->where('event_id' ,'=' ,$event_id)
                                            ->where('user_id' , '=' , Auth::user()->id);
        $subscriber->delete();
        return response()->json(['status' => 'success']);

        }

    public function newInfo($event_id , Request $request){
      EventInfo::create([
         'event_id' => $event_id,
         'body' => $request->description
      ]);
      $event = Event::find($event_id);

      $eventSubscibers = DB::table('event_user')->where('event_id' ,'=' , $event_id)->get();
      foreach($eventSubscibers as $subscriber){
         event(new EventSubscribers($event_id , $subscriber->user_id));

      }
      return response()->json(['status' => 'success']);

    }
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
            'user_id' => 'exists:users,id',
            'category' => 'exists:categories,id',
            'city' => 'exists:cities,id',
            'region' => 'exists:regions,id',
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
        $event->city_id=$request->city;
        $event->region_id=$request->region;
        $event->startdate=$request->startdate;
        $event->enddate=$request->enddate;
        $event->category_id=$request->category;
        $event->avaliabletickets=$request->avaliabletickets;
        $event->save();
       return redirect('events');
    }
    public function edit(Request $request){
        $event=Event::find($request->id);
        $categories=Category::all();
        return view('events.edit',[

            'event' => $event,
            'categories'=>$categories,


        ]);

    }
    public function update(Request $request){
        $event=Event::find($request->id);

       if($request->hasFile('photo'))
        {
        $request->file('photo')->store('public/images/events');
        $file_name = $request->file('photo')->hashName();
        $event->photo= $file_name;
        }
        $event->photo=$event->photo;
        $event->name = $request->name;
        $event->description=$request->description;
        $event->user_id= Auth::user()->id;
        $event->city=$request->city;
        $event->region=$request->region;
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

    public function search (Request $request){
        $events=Event::where('name', 'LIKE', '%'. $request->search .'%')->get();
        $cities = City::whereIn('id' , Event::all()->pluck('city_id'))->get();
        $categories = Category::whereIn('id' , Event::all()->pluck('category_id'))->get();
        $view='events.search';
        // if(Auth::check()){
        //     if(Auth::user()->hasRole('admin'))
        //     {
        //         $view='admin.events.search';
        //     }
        // }
        return view($view,compact('events','categories','cities'));
     }
}
