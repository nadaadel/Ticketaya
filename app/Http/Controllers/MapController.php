<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Event;


class MapController extends Controller
{
   public function eventsLocation(){
    $events = Event::all();

    Mapper::map(31.210786, 29.919482);

    foreach ($events as $event) {

        $location =  Mapper::location($event->location);
        Mapper::marker($location->getLatitude(), $location->getlongitude());
    }
       return view('events.map');
   }
}
