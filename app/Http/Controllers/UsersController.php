<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use App\Region;
use Auth;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{

    public function index (){
        $users=User::all();

        if(Auth::user()&&Auth::user()->hasRole('admin'))
        {
            return view('admin.users.index',compact('users'));
        }
        return view('notfound');

    }
    public function create(){
        $cities=City::all();
        if(Auth::user()&&Auth::user()->hasRole('admin'))
        {
            return view('admin.users.create',compact('cities'));
        }

        return view('notfound');

    }
    public function destroy($id){
        $user=User::find($id);
        $user->delete();
        if(Auth::user()&&Auth::user()->hasRole('admin'))
        {
            return response()->json(['response' => 'success']);
        }
        return redirect('users');
    }
    public function show($id){
        $user=User::find($id);
        if($user !== null){
        if(Auth::user() && Auth::user()->hasRole('admin')){
            return view('admin.users.show',['user'=> $user] );
        }
        
        return view('users.show',['user'=> $user] );
    
}
    return view('notfound');
}
    public function edit(Request $request){
        $user=User::find($request->id);

        $cities=City::all();
         if($user->city_id){
            $cityUser=City::find($user->city_id);
            $regions=$cityUser->regions;
            // dd($regions);
        }
        $regions=Region::all();

        $view='users.edit';
        if(Auth::user()&&Auth::user()->hasRole('admin'))
        {
            $view='admin.users.edit';
        }
        if(Auth::user()&&(Auth::user()->id==$request->id||Auth::user()->hasRole('admin'))){
        return view($view,['user'=> $user,
        'cities'=>$cities,'regions'=>$regions] );
        }
        else{
            return view('notfound');
        }
        
        


    }
    public function store (Request $request){
        $request->validate([
            'name'=>'required|min:4|max:200',
            'avatar'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'email'=>'required|email|unique:users',
        ]);
        $user=new User;
        if($request->hasFile('avatar')){
            $request->file('avatar')->store('public/images/users');
            $file_name = $request->file('avatar')->hashName();
            $user->avatar= $file_name;
        }
       
        $user->name = Str::lower($request->name);
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->city_id=$request->city;
        $user->region_id=$request->region;
        $user->phone=$request->phone;

        $user->save();
        
        if($request->role=="1"){

            $user->assignRole('admin');
        }
        if($request->role=="0"){

            $user->removeRole('admin');
        }

       return redirect('users');

    }

    public function  admin($id){
    if (Auth::check()&&Auth::user()->hasRole('admin')){
     $user=User::find($id);
     $user->assignRole('admin');
     return response()->json(['response' => 'success']);
    }
    else{
        return view('notfound');
    }

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
        $user->phone=$request->phone;
        $user->password=Hash::make($request->password);
        //dd($request->role);
        $user->save();
       
       
        if($request->role==null){

            $user->removeRole('admin');
        }



        return redirect('/users/'.$user->id);

    }
}
