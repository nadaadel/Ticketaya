<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use App\Region;
use Auth;
use DB;
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
            return redirect('admin/users');
        }
        return redirect('users');
    }
    public function show(Request $request){
        $user=User::find($request->id);
        $view='users.show';
        if(Auth::user()&&Auth::user()->hasRole('admin'))
        {
            $view='admin.users.show';
        }
        if(Auth::user()&&Auth::user()->id==$request->id){
        return view($view,['user'=> $user] );

    }
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
        if(Auth::user()&&Auth::user()->id==$request->id){
        return view($view,['user'=> $user,
        'cities'=>$cities,'regions'=>$regions] );
        }
        return view('notfound');


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
       return redirect('userss');

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

        $user->save();



        return redirect('/users/'.$user->id);

    }
}
