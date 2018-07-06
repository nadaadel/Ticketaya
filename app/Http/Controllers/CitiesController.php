<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CitiesController extends Controller
{
    public function show($id){
        $cityRegions=City::find($id)->regions;
        return response()->json(['res' => 'success','cityRegions'=>$cityRegions]);
     }
}
