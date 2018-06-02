<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;


class MapController extends Controller
{
   public function eventsLocation(){
    //  Mapper::map(31.222273, 29.917454)->informationWindow(31.222273, 29.917454 , 'Alexandria');
    //    Mapper::location('Alexandria');
    Mapper::location('Alexandria')->map(['zoom' => 15, 'center' => true, 'marker' => true]);

       return view('events.map');
   }
}
