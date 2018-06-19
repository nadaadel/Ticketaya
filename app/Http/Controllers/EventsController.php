<?php
namespace App\Http\Controllers;
use App\Event;
use App\EventInfo;
use DB;
use App\Category;
use App\Region;
use Auth;
use Carbon\Carbon;
use App\User;
use App\City;
use App\Events\EventSubscribers;
use App\Events\Question;
use App\Events\Answer;
use Illuminate\Http\Request;
use App\EventQuestion;
use Illuminate\Support\Str;

class EventsController extends Controller
{

    public function storeQuestion(Request $request){
        $questionfound=EventQuestion::where('question','=',$request->question)->first();
        $eventQuestion=EventQuestion::create([
            'event_id'=>$request->event_id,
            'user_id'=>$request->user_id,
            'question'=>$request->question,
        ]);
        //dd($eventQuestion);
        $asker=User::find($request->user_id);

        $event=Event::find($request->event_id);
        event(new Question($asker, $event));
        return response()->json(['questions' => $eventQuestion,'response'=>'success']);


    }
    public function updateQuestion(Request $request){
        $asker_id=$request->user_id;
        $event_id=$request->event_id;
        $question = EventQuestion::where([
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'question' => $request->question
        ])->first();

        $getQuestion = EventQuestion::find($question->id);
        $getQuestion->answer = $request->answer;
        $getQuestion->save();
        event(new Answer($asker_id, $event_id));
        return response()->json(['response'=>'success','answer' => $getQuestion]);
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
        $info=EventInfo::create([
         'event_id' => $event_id,
         'body' => $request->description
      ]);
      $event = Event::find($event_id);
      $eventSubscibers = DB::table('event_user')->where('event_id' ,'=' , $event_id)->get();
      foreach($eventSubscibers as $subscriber){
         event(new EventSubscribers($event_id , $subscriber->user_id));

      }

      $eventInfos=EventInfo::all();
      $time=Carbon::now();
      if(Auth::user()->hasRole('admin')){
        return response()->json(['status' => 'success','time'=>$time,'id'=>$info->id]);
        //return view('admin.events.show',['eventInfos'=> $eventInfos] );
      }
      return response()->json(['status' => 'success','time'=>$time,'id'=>$info->id]);

    }
    public function deleteInfo($id){
       $info= EventInfo::find($id);
       $event=Event::find($info->event_id);
       if(Auth::check()&& $event->user_id==Auth::user()->id){
        $info->delete();
        return response()->json(['response' => 'success']);
       }
       else{
        return view('notfound');
       }
      

    }
    public function search (Request $request){
        $events=Event::latest()->paginate(2);
        $cities = City::whereIn('id' , Event::all()->pluck('city_id'))->get();
        $categories = Category::whereIn('id' , Event::all()->pluck('category_id'))->get();
        $view='events.search';
        if($request->search !== null){
            $events=Event::where('name', 'LIKE', '%'. Str::lower($request->search) .'%')
            ->latest()
            ->paginate(3)
            ->setpath('');
           $events->appends(['search'=> $request->search]);
        }
        if( Auth::check() && Auth::user()->hasRole('admin')){
        $view='admin.search.Eventsearch';
        }
        return view($view,compact('events','categories','cities'));
    }



    public function index(){
        $events=Event::paginate(2);
        $categories=Category::all();
        $view='events.index';
        if(Auth::user()&& Auth::user()->hasRole('admin'))
        {
            $view='admin.events.index';
        }

        return view($view,compact('events','categories'));
    }

    public function create(){
        $categories=Category::all();
        $view='events.create';
        if(Auth::user()&& Auth::user()->hasRole('admin'))
        {
            $view='admin.events.create';
        }
        return view($view,compact('categories'));
    }
    public function show($id){
        $event = Event::find($id);
        $view='events.show';
        if(Auth::user()){
        $eventSubscibers = DB::table('event_user')->where('event_id' ,'=' , $id)->get();
        $subscribers = DB::table('event_user')->where('event_id' ,'=' , $id)
        ->where('user_id' , '=' , Auth::user()->id)->get();

        }
        $questions=EventQuestion::where('event_id',$id)->latest()->paginate(2);


        $eventInfos = EventInfo::where('event_id','=',$event->id)->orderBy('created_at', 'desc')->paginate(2);
        if(Auth::user()&& Auth::user()->hasRole('admin'))
        {
            $view='admin.events.show';
        }

        return view( $view, compact('event' , 'subscribers' ,'eventInfos','questions'));
    }
    public function deleteQuestion($id){
       
       $question= EventQuestion::find($id);
       $event=Event::find($question->event_id);
       if(Auth::check()&&Auth::user()&&(($question->user_id==Auth::user()->id))||($event->user_id==Auth::user()->id)||(Auth::user()->hasRole('admin'))){
       $question->delete();
       return response()->json(['response' => 'success']);
       }
       else{
        return view('notfound');
       }

    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:4|max:200',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'startdate' => 'required|date|after:'.Carbon::now().'|before_or_equal:enddate',
            'enddate'  => 'required|date|after_or_equal:startdate',
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
        $event->name = Str::lower($request->name);
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
        $regions = Region::all();
        $cities = City::all();
        $view='events.edit';
        if(Auth::user()&& Auth::user()->hasRole('admin')){
            $view='admin.events.edit';
        }
        if(Auth::check()&&($event->user_id==Auth::user()->id||Auth::user()->hasRole('admin'))){
        return view($view,[

            'event' => $event,
            'categories'=>$categories,
            'cities' => $cities,
            'regions' => $regions



        ]);
        }
        else{
            return view('notfound');
        }

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
        $event->city_id=$request->city;
        $event->region_id=$request->region;
        $event->startdate=$request->startdate;
        $event->enddate=$request->enddate;
        $event->category_id=$request->category;
        $event->avaliabletickets=$request->avaliabletickets;
        if(Auth::check()&&(Auth::user()->id==$event->user_id||Auth::user()->hasRole('admin'))){
            $event->save();
        return redirect('events');
        }
        else{
            return view('notfound');
        }

     }


    public function delete($id){
        $event = Event::find($id);
        if(Auth::check()&&(Auth::user()->id==$event->user_id||Auth::user()->hasRole('admin'))){
        $event->delete();

        return response()->json(['response' => 'success']);
        }
        else{
            return view('notfound');
        }
    }

}
