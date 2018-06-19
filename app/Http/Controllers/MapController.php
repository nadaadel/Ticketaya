<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Event;
use App\Ticket;
use Auth;
class MapController extends Controller
{
   public function getEventLocation($id){
    $event = Event::find($id);
    $location = Mapper::location($event->region->name);
    Mapper::map($location->getLatitude(), $location->getLongitude());
    return view('events.show');
   }

   public function eventsLocation(){

    $events = Event::all();
    Mapper::map(31.218163, 29.919514);
    foreach ($events as $event) {
        $location = Mapper::location($event->region->name);
        Mapper::marker($location->getLatitude(), $location->getLongitude());
    }
    if(Auth::user()->hasrole('admin')){
        return view('admin.maps.events');
    }
       return view('events.map');
   }

   public function ticketLocations(){
    $tickets = Ticket::all();
    Mapper::map(31.218163, 29.919514);
    foreach ($tickets as $ticket) {

        $location = Mapper::location($ticket->region->name);
        Mapper::marker($location->getLatitude(), $location->getLongitude());
    }
    if(Auth::user()->hasrole('admin')){
        return view('admin.maps.tickets');
    }
       return view('tickets.map');
   }
}
