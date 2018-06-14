<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;

class FilterTicketsController extends Controller
{

   public function byCategory($category_id){
       $tickets = Ticket::where('category_id' , '=' , $category_id)->get();
       $categories = Category::all();
       return view('tickets.index' , compact('tickets' , 'categories'));
   }


    public function filter(Request $request){

    $tickets = [];
    $ticketsCity= [];
    $ticketsCategory = [];
    $ticketsPrice = [];
    if($request['category'] && $request['city'] && ($request['price']||$request['highprice'])){

        if($request['highprice']){

            $getCategory  = Category::where('name' ,'=' , $request['category'])->first();
            $tickets = Ticket::where('category_id' , '=' ,  $getCategory->id)
                              ->where('city' , '=' , $request['city'])
                              ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
                              ->get();
        }
        else{
            $getCategory  = Category::where('name' ,'=' , $request['category'])->first();
            $tickets = Ticket::where('category_id' , '=' ,  $getCategory->id)
             ->where('city' , '=' , $request['city'])
             ->whereBetween('price'  , [$request['price'],$request['price']+50])
             ->get();
        }
    }
    elseif($request['category'] && $request['city']){
        $getCategory  = Category::where('name' ,'=' , $request['category'])->first();
        $tickets = Ticket::where('category_id' , '=' ,  $getCategory->id)
         ->where('city' , '=' , $request['city'])->get();


    }

    elseif($request['category'] && ($request['price']||$request['highprice'])){
        if($request['price']){
        $getCategory  = Category::where('name' ,'=' , $request['category'])->first();
            $tickets = Ticket::where('category_id' , '=' ,  $getCategory->id)

             ->whereBetween('price'  , [$request['price'],$request['price']+50])
             ->get();
        }
        else{
            $getCategory  = Category::where('name' ,'=' , $request['category'])->first();
            $tickets = Ticket::where('category_id' , '=' ,  $getCategory->id)

             ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
             ->get();

        }


    }
    elseif($request['city'] && ($request['price']||$request['highprice'])){

        if($request['price']){

            $tickets = Ticket::where('city' , '=' , $request['city'] )

             ->whereBetween('price'  , [$request['price'],$request['price']+50])
             ->get();
        }
        else{

            $tickets = Ticket::where('city' , '=' , $request['city'] )

             ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
             ->get();

        }
    }


    elseif($request['category']){
        $getCategory  = Category::where('name' ,'=' , $request['category'])->first();
        $tickets = Ticket::where('category_id' , '=' ,  $getCategory ->id)->get();

    }
    elseif($request['city']){
        $tickets  = Ticket::where('city' , '=' , $request['city'])->get();
    }

    elseif($request['price']){

        $tickets = Ticket::whereBetween('price'  , [$request['price'],$request['price']+50])->get();

    }
    elseif($request['highprice']){

        $tickets = Ticket::whereBetween('price'  , [$request['highprice'],$request['highprice']+100000])->get();

    }





   /* if(!$tickets){
        if(!$ticketsCity){
           $alltickets=$ticketsCategory;
           $tickets= $alltickets->merge($ticketsPrice);
        }
        $alltickets  = $ticketsCity->merge($ticketsCategory);
        //$tickets= $alltickets->merge($ticketsPrice);
    }*/


      return view('search.search' , compact('tickets'));
    }
}
//whereBetween
