<?php

namespace App\Http\Controllers;
use DB;
use App\Ticket;
use App\User;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function show($id){
        $ticket = Ticket::find($id);
        return view('tickets.show' , compact('ticket'));
    }

    public function spamTicket($id){
        DB::table('spam_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => Auth::user()->id
        ]);
    }
    public function requestTicket(Request $request ,$id){
        DB::table('requested_tickets')->insert([
            'ticket_id' => $id,
            'buyer_id' => 1,
            'quantity' => $request->quantity ,
        ]);
    }

    public function getUserRequests(Request $request){
    //    $buyerTicket =  DB::table('requested_tickets')->where('buyer_id' , '=' , Auth::user()->id);
       $user = User::find(1);

       dd($user->requests());

     /*  $buyerTicket =  DB::table('requested_tickets')->where('buyer_id' , '=' , '1');
       dd($buyerTicket);*/
       /*
       foreach ($buyerTicket as $value) {
             dd($value);
       }
*/
    }

    public function getSellerRequests(Request $request ,$id){
        DB::table('requested_tickets')->insert([
            'ticket_id' => $id,
            'buyer_id' => Auth::user()->id,
            'quantity' => $request->quantity ,
        ]);
    }



}
