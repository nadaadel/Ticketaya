<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function spamTicket($id){
        DB::table('spam_tickets')->insert([
            'ticket_id' => $id,
            'user_id' => Auth::user()->id
        ]);
    }

}
