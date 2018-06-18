<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Event;
use App\RequestedTicket;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotTickets  = RequestedTicket::all()->groupBy('ticket_id')->first();
        // dd($hotTickets);
        $hotTickets  = Ticket::orderBy('created_at' , 'desc')->take(6)->get();
        $hotEvents   = Event::orderBy('created_at' , 'desc')->take(6)->get();
        return view('home' , compact('hotTickets' , 'hotEvents'));
    }
}
