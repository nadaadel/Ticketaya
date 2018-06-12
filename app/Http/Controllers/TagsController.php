<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Auth;

class TagsController extends Controller
{
    public function allTags(){
     $tags = Tag::all();
        if(Auth::check() && Auth::user()->hasRole('admin')){
            return view('admin.tags.index' , compact('tags'));
        }
        return view('notfound');
    }
    public function create(){
        if(Auth::check() && Auth::user()->hasRole('admin')){
            return view('admin.tags.create');
        }
        return view('notfound');
    }
    public function store(Request $request){
        if(Auth::check()  && Auth::user()->hasRole('admin') ){
            Tag::create([
            'name' => $request->name
        ]);
        return redirect('/tags');
            }
        return view('notfound');
    }
    public function edit($id){
        $tag = Tag::find($id);
        if($tag !== null){
        if(Auth::check() && Auth::user()->hasRole('admin')){
            return view('admin.tags.edit' , compact('tag'));
        }
    }
    return view('notfound');
    }
      public function show($id){
        $tag = Tag::find($id);
        if($tag !== null){
            if(Auth::check() && Auth::user()->hasRole('admin')){
                return view('admin.tags.show' , compact('tag'));
            }
        }
        return view('notfound');

    }


    public function tagTickets($id){
        $tag = Tag::find($id);
        if($tag !== null){
            $tickets=$tag->tickets;
                if(Auth::check() && Auth::user()->hasRole('admin')){
                    return view('admin.tags.show_tickets' , compact('tickets','tag'));
                }
        }
        return view('notfound');

    }

    public function update(Request $request ,$id){
        $getTag = Tag::find($id);
        if($getTag !== null){
            if(Auth::check() && Auth::user()->hasRole('admin')){
                $getTag->name = $request->name;
                $getTag->save();
            }
        return redirect('/tags');
        }
        return view('notfound');
    }
    public function delete($id){
        $getTag = Tag::find($id);
        if($getTag !== null){
            if(Auth::check() && Auth::user()->hasRole('admin')){
                $getTag->delete();
                return redirect('/tags');
            }

        }
        return view('notfound');
    }

}
