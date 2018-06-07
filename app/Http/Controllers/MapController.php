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

        $location =  Mapper::location($event->region);
        Mapper::marker($location->getLatitude(), $location->getlongitude());
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

        $location =  Mapper::location($ticket->region);
        Mapper::marker($location->getLatitude(), $location->getlongitude());
    }
    if(Auth::user()->hasrole('admin')){
        return view('admin.maps.tickets');
    }
       return view('tickets.map');
   }
}
