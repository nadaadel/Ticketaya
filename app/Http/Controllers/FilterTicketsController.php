<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\City;
use App\Event;
use App\Category;
use Auth;

class FilterTicketsController extends Controller
{

    public function byCategory($category_id){
        $tickets = Ticket::where('category_id' , '=' , $category_id)->paginate(4);
        $categories = Category::all();
        return view('tickets.index' , compact('tickets' , 'categories'));
    }



    public function filter(Request $request){
    $cityIds=[];
    $categoryIds=[];
    $cities = City::whereIn('id' , Ticket::all()->pluck('city_id'))->get();
    $categories = Category::whereIn('id' , Ticket::all()->pluck('category_id'))->get();
    if($request['city']){
        $getCity  = City::whereIn('name' , $request['city'])->get();
        foreach($getCity as $city)
        {
            $cityIds[] = $city->id;
         }
         $tickets = Ticket::whereIn('city_id' , $cityIds)->get();
        if($request['category']){
            $getCategory  = Category::whereIn('name' , $request['category'])->get();
            foreach($getCategory as $cat)
            {
                $categoryIds[] = $cat->id;
             }
             $tickets= Ticket::whereIn('category_id' , $categoryIds)
             ->whereIn('city_id' , $cityIds)
             ->get();
        }
        if($request['highprice']){
            if($categoryIds){
            $tickets = Ticket::whereIn('category_id' , $categoryIds)
            ->whereIn('city_id' ,  $cityIds)
            ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
            ->get();
            }else{
            $tickets = Ticket::whereIn('city_id' , $cityIds)
            ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
            ->get();
            }


        }
        if($request['price']){
            if($categoryIds){
            $tickets = Ticket::whereIn('category_id' , $categoryIds)
            ->whereIn('city_id' ,  $cityIds)
            ->whereBetween('price'  , [$request['price'],$request['price']+50])
            ->get();

            }
            else{
                $tickets = Ticket::whereIn('city_id' ,  $cityIds)
                ->whereBetween('price'  , [$request['price'],$request['price']+50])
                ->get();

            }

        }
    }
    elseif($request['category']){
        $getCategory  = Category::whereIn('name' ,$request['category'])->get();

        foreach($getCategory as $cat)
        {
            $categoryIds[] = $cat->id;
         }

        $tickets = Ticket::whereIn('category_id' ,  $categoryIds)->get();

        if($request['highprice']){

            $tickets = Ticket::whereIn('category_id' ,  $categoryIds)

            ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
            ->get();
            //dd($tickets);


        }
        if($request['price']){

            $tickets = Ticket::whereIn('category_id' ,   $categoryIds)
            ->whereBetween('price'  , [$request['price'],$request['price']+50])
            ->get();
             //dd($tickets);



        }


    }
    elseif($request['highprice']){
        $tickets = Ticket::whereBetween('price'  , [$request['highprice'],$request['highprice']+100000])->get();


    }
    elseif($request['price']){
        $tickets = Ticket::whereBetween('price'  , [$request['price'],$request['price']+50])->get();

    }
    if(Auth::check() && Auth::user()->hasRole('admin')){
        return view('admin.search.Ticketsearch' , compact('tickets','categories','cities'));
    }

      return view('search.Ticketsearch' , compact('tickets','categories','cities'));
    }



}










