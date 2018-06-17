<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;
use App\City;
use App\Region;
use Auth;

class FilterEventController extends Controller
{

    public function byCategory($category_id){
        $events = Event::where('category_id' , '=' , $category_id)->paginate(4);
        $categories = Category::all();
        return view('events.index' , compact('events' , 'categories'));
    }


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
         $events = Event::whereIn('city_id' , $cityIds)->paginate(2);
         $events->appends(['city' => $request['city'],'category'=> $request['category']]);
        if($request['category']){
            $getCategory  = Category::whereIn('name' , $request['category'])->get();
            foreach($getCategory as $cat)
            {
                $categoryIds[] = $cat->id;
             }
             $events= Event::whereIn('category_id' , $categoryIds)
             ->whereIn('city_id' , $cityIds)->paginate(2);
             $events->appends(['city' => $request['city'],'category'=> $request['category']]);
        }
    }
    elseif($request['category']){
        $getCategory  = Category::whereIn('name' ,$request['category'])->get();
        foreach($getCategory as $cat)
        {
            $categoryIds[] = $cat->id;
         }
        $events = Event::whereIn('category_id' ,  $categoryIds)->paginate(2);
        $events->appends(['city' => $request['city'],'category'=> $request['category']]);
    }
    if(Auth::check() && Auth::user()->hasRole('admin')){

        return view('admin.search.Eventsearch' , compact('events','categories','cities'));
    }
    return view('events.search' , compact('events','categories','cities'));
    }
}

