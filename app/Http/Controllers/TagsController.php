<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function allTags(){
     $tags = Tag::all();

    }
    public function create(Request $request){
        Tag::create([
            'name' => $request->name
        ]);
    }
    public function edit($id){
        $getTag = Tag::find($id);

    }
    public function update(Request $request ,$id){
        $getTag = Tag::find($id);
        $getTag->name = $request->name;
    }
    public function delete($id){
        $getTag = Tag::find($id);
        $getTag->delete();

    }

}
