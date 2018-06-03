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
use App\Events\TicketRequested;
use App\Events\StatusTicketRequested;
// use App\Http\Controllers\Flashy;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index (){
        $tickets=Ticket::all();
        return view('tickets.index',compact('tickets'));
     }

    public function show($id){
        $ticket = Ticket::find($id);
        $userSpam = DB::table('spam_tickets')->where('user_id' , '=' , Auth::user()->id)->get();
        return view('tickets.show' , compact('ticket' , 'userSpam'));
    }
    public function spamTicket($id){
        DB::table('spam_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => Auth::user()->id
        ]);
        flashy()->error('This Ticket Spammed By You');
        return redirect('/tickets/'.$id );
    }

    public function requestTicket(Request $request ,$id){
        $ticket = Ticket::find($id);
        $quantity=$request->quantity;
        if ($quantity<=$ticket->quantity){

        RequestedTicket::create([
            'ticket_id' => $id,
            'user_id' => $ticket->user_id,
            'requester_id' => Auth::user()->id,
            'quantity' => $request->quantity ,
        ]);
      
        // send request notification to ticket author
        event(new TicketRequested($ticket->name , Auth::user()->name , $ticket->user_id,$request));
        return response()->json(['response' => 'ok']);
        
        }
        return response()->json(['quantity' =>$ticket->quantity ]);
    
    }


    public function getUserRequests(Request $request){
    /** User Tickets received Requests */
    $userRequestsReceived =RequestedTicket::all()->where('user_id' , '=' , Auth::user()->id);
    $userTicketsSold = SoldTicket::all()->where('user_id' , '=' , Auth::user()->id);

    /** User Tickets Send Requests */
    $userRequestsWanted = RequestedTicket::all()->where('requester_id' , '=' , Auth::user()->id);
    $userTicketsBought = SoldTicket::all()->where('buyer_id' , '=' , Auth::user()->id);


     return view('tickets.userRequests' , compact('userRequestsReceived' , 'userTicketsSold' ,
    'userRequestsWanted' , 'userTicketsBought'));
    }

    public function acceptTicket($id , $requester_id){
        $user = User::find(Auth::user()->id);
        
        $request = $user->requestedTicket()->where('requester_id' , '=' , $requester_id)
                                            ->where('is_accepted','=',0)->first();
        $request->pivot->is_accepted = 1;
        $request->pivot->save();
        $requestedTicket=RequestedTicket::all()->where('requester_id' , '=' , $requester_id)->first();
        event(new StatusTicketRequested( $requestedTicket));
        
        return redirect('/tickets/requests');


    }
    //to edit quantity in ticket request
    public function editRequestedTicket(Request $request,$id){
        
        $ticket = Ticket::find($request->ticket_id);
        if ($request->quantity<=$ticket->quantity){

        
        $user = User::find($ticket->user_id);
        $requestTicket = $user->requestedTicket()->where('requester_id' , '=' ,$id)->first();
        $requestTicket->pivot->quantity =$request->quantity;
        
        $requestTicket->pivot->save();
        event(new TicketRequested($ticket->name , Auth::user()->name , $ticket->user_id,$request));
        
        return response()->json(['response' => 'ok']);
        }
        return response()->json(['quantity' =>$ticket->quantity ]);
        
       
    }
    public function cancelTicketRequest($id , $requester_id){
        $user = User::find(Auth::user()->id);
        $request = $user->requestedTicket()->where('requester_id' , '=' , $requester_id)->first();
        $request->pivot->delete();
        return redirect('/tickets/requests');
    }
   public function ticketSold($id){
       $ticket = Ticket::find($id);
       $ticket->is_sold =1;
       $ticket->save();
       $requested =  RequestedTicket::where([['ticket_id' , '=' , $id] ,
       ['requester_id' , '=' , Auth::user()->id] ,
       ['user_id' , '=' , $ticket->user_id]])->get();
       $requested[0]->is_sold = 1;
       $requested[0]->save();

       SoldTicket::create([
        'ticket_id' => $id,
        'user_id' => $ticket->user_id,
        'buyer_id' => Auth::user()->id,
        'quantity' => '2' ,
       ]);

      return redirect('/tickets/requests');
    }

     public function view ($id){
        $ticket=Ticket::find($id);
        $userSpam = DB::table('spam_tickets')->where('user_id' , '=' , Auth::user()->id)->get();
        return view('tickets.view',compact('ticket' , 'userSpam'));
     }

     public function search (Request $request){
        $tickets=Ticket::all()->where('name' , '=' , $request->search);

        return view('search.search',['tickets'=> $tickets] );
     }

    public function create (){
        $categories=Category::all();
        return view('tickets.create',compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required|min:3',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
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
