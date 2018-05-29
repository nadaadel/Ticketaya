<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;

class FilterTicketsController extends Controller
{
    public function byCategory($category_name){
     $getCategory  = Category::where('name' ,'=' , $category_name)->first();
     $tickets = Ticket::where('category_id' , '=' , $getCategory->id)->get();
     dd($tickets);
    //  return view('tickets.searchResult' , compact('tickets'));
    }
}
