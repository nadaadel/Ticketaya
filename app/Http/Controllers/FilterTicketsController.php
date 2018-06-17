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

 


    public function filter(Request $request){
    $cityIds=[];
    $categoryIds=[];
    $cities = City::whereIn('id' , Ticket::all()->pluck('city_id'))->get();
    $categories = Category::whereIn('id' , Ticket::all()->pluck('category_id'))->get();
    if(!$request['city']&& !$request['category']&&!$request['highprice']&&!$request['price']){
        $tickets = Ticket::latest()->paginate(2); 
    }
    if($request['city']){
        $getCity  = City::whereIn('name' , $request['city'])->get();
        foreach($getCity as $city)
        {
            $cityIds[] = $city->id;
         }
         $tickets = Ticket::whereIn('city_id' , $cityIds)->paginate(2);
         $tickets->appends(['city'=> $request['city']]);
        if($request['category']){
            $getCategory  = Category::whereIn('name' , $request['category'])->get();
            foreach($getCategory as $cat)
            {
                $categoryIds[] = $cat->id;
             }
             $tickets= Ticket::whereIn('category_id' , $categoryIds)
             ->whereIn('city_id' , $cityIds)
             ->paginate(2);
             $tickets->appends(['city'=> $request['city'],'category'=>$request['category']]);
             
        }
        if($request['highprice']){
            if($categoryIds){
            $tickets = Ticket::whereIn('category_id' , $categoryIds)
            ->whereIn('city_id' ,  $cityIds)
            ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
            ->paginate(2);
            $tickets->appends(['city'=> $request['city'],'category'=>$request['category'],'price'=>$request['highprice']]);
            }else{
            $tickets = Ticket::whereIn('city_id' , $cityIds)
            ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
            ->paginate(2);
            $tickets->appends(['city'=> $request['city'],'price'=>$request['highprice']]);
            }


        }
        if($request['price']){
            if($categoryIds){
            $tickets = Ticket::whereIn('category_id' , $categoryIds)
            ->whereIn('city_id' ,  $cityIds)
            ->whereBetween('price'  , [$request['price'],$request['price']+50])
            ->paginat(2);
            $tickets->appends(['city'=> $request['city'],'category'=>$request['category'],'price'=>$request['price']]);
         
            }
            else{
                $tickets = Ticket::whereIn('city_id' ,  $cityIds)
                ->whereBetween('price'  , [$request['price'],$request['price']+50])
                ->paginate(2);
                $tickets->appends(['city'=> $request['city'],'price'=>$request['price']]);

            }

        }
    }
    elseif($request['category']){
        $getCategory  = Category::whereIn('name' ,$request['category'])->get();
        
        foreach($getCategory as $cat)
        {
            $categoryIds[] = $cat->id;
         }
       
        $tickets = Ticket::whereIn('category_id' ,  $categoryIds)->paginate(2);
        $tickets->appends(['category'=>$request['category']]);
       
        if($request['highprice']){
            
            $tickets = Ticket::whereIn('category_id' ,  $categoryIds)
            
            ->whereBetween('price'  , [$request['highprice'],$request['highprice']+10000])
            ->paginate(2);
            $tickets->appends(['category'=>$request['category'],'price'=>$request['highprice']]);
            //dd($tickets);


        }
        if($request['price']){
        
            $tickets = Ticket::whereIn('category_id' ,   $categoryIds)
            ->whereBetween('price'  , [$request['price'],$request['price']+50])
            ->paginate(2);
            $tickets->appends(['category'=>$request['category'],'price'=>$request['price']]);
             //dd($tickets);
            
            

        }


    }
    elseif($request['highprice']){
        $tickets = Ticket::whereBetween('price'  , [$request['highprice'],$request['highprice']+100000])->paginate(2);
        $tickets->appends(['price'=>$request['highprice']]);


    }
    elseif($request['price']){
        $tickets = Ticket::whereBetween('price'  , [$request['price'],$request['price']+50])->paginate(2);
        $tickets->appends(['price'=>$request['price']]);

    }
    if(Auth::check() && Auth::user()->hasRole('admin')){
        return view('admin.search.Ticketsearch' , compact('tickets','categories','cities'));
    }

      return view('search.Ticketsearch' , compact('tickets','categories','cities'));
    }



}







  


