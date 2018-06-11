<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Event;
use App\Ticket;
use Auth;
class MapController extends Controller
{
   public function eventsLocation(){

    $events = Event::all();
    Mapper::map(31.210786, 29.919482);
    foreach ($events as $event) {
        Mapper::marker($event->region->latitude, $event->region->longitude);
    }
    if(Auth::user()->hasrole('admin')){
        return view('admin.maps.events');
    }
       return view('events.map');
   }

   public function ticketLocations(){
    $tickets = Ticket::all();
    Mapper::map(31.210786, 29.919482);
    foreach ($tickets as $ticket) {

        Mapper::marker($ticket->region->latitude, $ticket->region->longitude);
    }
    if(Auth::user()->hasrole('admin')){
        return view('admin.maps.tickets');
    }
       return view('tickets.map');
   }
}
