<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;

class FilterTicketsController extends Controller
{
    public function filter(Request $request){

    $tickets = [];
    $ticketsCity= [];
    $ticketsCategory = [];
    if($request['category']){
        $getCategory  = Category::where('name' ,'=' , $request['category'])->first();
        $ticketsCategory = Ticket::where('category_id' , '=' , $getCategory->id)->get();

    }
    if($request['city']){
        $ticketsCity  = Ticket::where('city' , '=' , $request['city'])->get();
    };

      $tickets  = $ticketsCity->merge($ticketsCategory);
      return view('search.search' , compact('tickets'));
    }
}
