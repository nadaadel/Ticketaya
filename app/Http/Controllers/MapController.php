<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Event;
use App\Ticket;


class MapController extends Controller
{
   public function eventsLocation(){

    $events = Event::all();
    Mapper::map(31.210786, 29.919482);
    foreach ($events as $event) {

        $location =  Mapper::location($event->region);
        Mapper::marker($location->getLatitude(), $location->getlongitude());
    }
       return view('events.map');
   }

   public function adminEventLocations(){
    $events = Event::all();
    Mapper::map(31.210786, 29.919482);
    foreach ($events as $event) {

        $location =  Mapper::location($event->region);
        Mapper::marker($location->getLatitude(), $location->getlongitude());
    }
       return view('admin.maps.events');
   }

   public function adminTicketLocations(){
    $tickets = Ticket::all();
    Mapper::map(31.210786, 29.919482);
    foreach ($tickets as $ticket) {

        $location =  Mapper::location($ticket->region);
        Mapper::marker($location->getLatitude(), $location->getlongitude());
    }
       return view('admin.maps.tickets');
   }
}
