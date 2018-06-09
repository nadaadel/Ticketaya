<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;
use App\City;
use App\Region;

class FilterEventController extends Controller
{
    public function filter(Request $request){

    $events = [];
    $cities = City::whereIn('id' , Event::all()->pluck('city_id'))->get();
    $categories = Category::whereIn('id' , Event::all()->pluck('category_id'))->get();
    $categoryIds= [];
    $cityIds = [];
    if($request['city']){
        $getCity  = City::whereIn('name' , $request['city'])->get();
        foreach($getCity as $city)
        {
            $cityIds[] = $city->id;
         }
         $events = Event::whereIn('city_id' , $cityIds)->get();
        if($request['category']){
            $getCategory  = Category::whereIn('name' , $request['category'])->get();
            foreach($getCategory as $cat)
            {
                $categoryIds[] = $cat->id;
             }
             $events= Event::whereIn('category_id' , $categoryIds)
             ->whereIn('city_id' , $cityIds)
             ->get();
        }
    }
    elseif($request['category']){
        $getCategory  = Category::whereIn('name' ,$request['category'])->get();
        foreach($getCategory as $cat)
        {
            $categoryIds[] = $cat->id;
         }
        $events = Event::whereIn('category_id' ,  $categoryIds)->get();

    }
    return view('events.search' , compact('events','categories','cities'));
    }
}

