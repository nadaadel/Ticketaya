<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function show(Request $request){
        $user=User::find($request->id);
       
        return view('users.show',['user'=> $user] );

    }
    public function edit(Request $request){
        $user=User::find($request->id);
        $cities=City::all();
        
        return view('users.edit',['user'=> $user,
        'cities'=>$cities] );

    }
    public function update (Request $request){
        $user=User::find($request->id);
        if($request->hasFile('avatar'))
        {
        $request->file('avatar')->store('public/images/users');
        $file_name = $request->file('avatar')->hashName();
        $user->avatar= $file_name;
        }
        if($request->region){
            $user->region_id=$request->region; 
        }
        $user->avatar=$user->avatar;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->city_id=$request->city;
        $user->region_id=$user->region_id;
        $user->password=Hash::make($request->password);
       
        $user->save();
       

        
        return redirect('/users/'.$user->id);

    }
}
