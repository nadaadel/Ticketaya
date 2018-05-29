<?php

namespace App\Http\Controllers;
use DB;
use App\Ticket;
use App\User;
use App\RequestedTicket;
use App\SoldTicket;
use Auth;


use Illuminate\Http\Request;

class TicketsController extends Controller
{


    public function index(){
        
        $tickets=Ticket::All();
     

        return view('tickets.index',[
         'tickets'=> $tickets,
      
        ]);
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

        return redirect('/tickets/show/'.$id );
    }
    public function requestTicket(Request $request ,$id){
        $ticket = Ticket::find($id);
        DB::table('requested_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => $ticket->user_id,
            'requester_id' => Auth::user()->id,
            'quantity' => $request->quantity ,
        ]);
        return redirect('/tickets/requests');
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
        $request = $user->requestedTicket()->where('requester_id' , '=' , $requester_id)->first();
        $request->pivot->is_accepted = 1;
        $request->pivot->save();
        return redirect('/tickets/requests');

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
        DB::table('sold_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => $ticket->user_id,
            'buyer_id' => Auth::user()->id,
            'quantity' => '2' ,
        ]);

      return redirect('/tickets/requests');
    }
}
