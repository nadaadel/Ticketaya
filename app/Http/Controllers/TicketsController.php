<?php

namespace App\Http\Controllers;
use DB;
use App\Ticket;
use App\User;
use App\RequestedTicket;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function show($id){
        $ticket = Ticket::find($id);
        $userSpam = DB::table('spam_tickets')->where('user_id' , '=' , 1)->get();
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

        DB::table('requested_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => 1,
            'quantity' => $request->quantity ,
        ]);
        return redirect('/tickets/requests');
    }

    public function getUserRequests(Request $request){

    $userRequests = User::find(1)->tickets;

    /** My Tickets Requests */
    $userRequestsReceived = User::find(1)->requestedTicket;
    $userTicketsSold = User::find(1)->soldTickets;
   
     return view('tickets.userRequests' , compact('userRequestsReceived' , 'userTicketsSold'));
    }

    public function acceptTicket($id , $requester_id){
        $user = User::find(1);
        $request = $user->requestedTicket()->where('requester_id' , '=' , $requester_id)->first();
        $request->pivot->is_accepted = 1;
        $request->pivot->save();
        return redirect('/tickets/requests');

    }

    public function cancelTicketRequest($id , $requester_id){
        $user = User::find(1);
        $request = $user->requestedTicket()->where('requester_id' , '=' , $requester_id)->first();
        $request->pivot->delete();
        return redirect('/tickets/requests');

    }
   public function ticketSold($id){
       $ticket = Ticket::find($id);
       $ticket->is_sold =1;
        DB::table('sold_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => 1,
            'quantity' => '2' ,
        ]);

      return redirect('/tickets/requests');
    }
}
