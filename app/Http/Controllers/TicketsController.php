<?php

namespace App\Http\Controllers;
use DB;
use App\Ticket;
use App\User;
use Image;
use Auth;
use App\Category;
use App\RequestedTicket;
use App\SoldTicket;
use App\Tag;
use App\Notification;
use App\Events\TicketRequested;
use App\Events\TicketReceived;
use App\Events\StatusTicketRequested;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index (){
        $tickets=Ticket::all();
        return view('tickets.index',compact('tickets'));
     }

    public function show($id){
        $ticket = Ticket::find($id);
        if(Auth::check()){
                $userSpam = DB::table('spam_tickets')->where('user_id' , '=' , Auth::user()->id)->get();
                $requestStatus = RequestedTicket::where([
                ['requester_id' , '=' , Auth::user()->id],
                ['ticket_id' , '=' , $id]
                ])->get();
                $wantStatus = true;
                if(sizeof($requestStatus) == 1){
                  $wantStatus = false;
                }
        $numberofspams=$ticket->spammers->count();
        $userSavedTicket=Auth::user()->savedTickets->contains($id);
        return view('tickets.show' , compact('ticket' , 'userSpam' , 'wantStatus','numberofspams','userSavedTicket'));
        }
        return view('tickets.show' , compact('ticket'));

    }
    public function spamTicket($id){
        DB::table('spam_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => Auth::user()->id
        ]);
        flashy()->error('This Ticket Spammed By You');
        return redirect('/tickets/'.$id );
    }
    public function view ($id){
        $ticket=Ticket::find($id);
        return view('tickets.view',compact('ticket'));
     }

     public function search (Request $request){
        $tickets=Ticket::all()->where('name' , '=' , $request->search);

        return view('search.search',['tickets'=> $tickets] );
     }

    public function create (){
        $categories=Category::all();
        return view('tickets.create',compact('categories'));
    }

    public function saveTicket($id){
        $user=Auth::user();
        if(!$user->savedTickets->contains($id)){
            $user->savedTickets()->attach($id);
        }
        return response()->json(['res' => 'success']);
    }
    public function unsaveTicket($id){
        $user=Auth::user();
        if($user->savedTickets->contains($id)){
            $user->savedTickets()->detach($id);
        }
        return response()->json(['res' => 'success']);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:3',
            'price'=>'required|numeric',
            'quantity'=>'required|integer|digits_between: 1,10',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'expire_date' => 'required|date|after_or_equal:'.Carbon::now(),
            'user_id' => 'exists:users,id',
            'category' => 'exists:categories,id',

        ]);
        $ticket=new Ticket;
        if($request->hasFile('photo')){
            $request->file('photo')->store('public/images/tickets');
            $file_name = $request->file('photo')->hashName();
            $ticket->photo= $file_name;
        }

        $ticket->price =$request->price;
        $ticket->name = $request->name;
        $ticket->description=$request->description;
        $ticket->user_id= Auth::user()->id;
        $ticket->quantity=$request->quantity;
        $ticket->region=$request->region;
        $ticket->city=$request->city;
        $ticket->expire_date=$request->expire_date;
        $ticket->category_id=$request->category;
        $ticket->type=1;
        $ticket->is_sold= 0;
        $ticket->save();
        if($ticket)
        {
            $tagNames = explode(',' ,$request->tags);
            $tagIds = [];
            foreach($tagNames as $tagName)
            {
                $tag = Tag::firstOrCreate(['name'=>$tagName]);
                if($tag)
                {
                  $tagIds[] = $tag->id;
                }

            }
            $ticket->tags()->sync($tagIds);
        }
       return redirect('tickets');
    }

    public function edit($id){
        $ticket=Ticket::find($id);
        $categories=Category::all();
        return view('tickets.update',['ticket'=> $ticket,'categories'=>$categories] );
    }

    public function update($id, Request $request){
        $ticket= Ticket::find($id);
        $ticket->price =$request->price;
        $ticket->name = $request->name;
        $ticket->description=$request->description;
        $ticket->user_id= Auth::user()->id;
        $ticket->quantity=$request->quantity;
        $ticket->region=$request->region;
        $ticket->city=$request->city;
        $ticket->expire_date=$request->expire_date;
        $ticket->category_id=$request->category;
        if($request->hasFile('photo')){
            $request->file('photo')->store('public/images/tickets');
            $file_name = $request->file('photo')->hashName();
            $ticket->photo= $file_name;
        }

        $ticket->save();
        return redirect('tickets');
     }

     public function destroy($id){
        $ticket=Ticket::find($id);
        $ticket->delete();
        return redirect('tickets');
    }

}
