<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoriesController extends Controller
{

    public function index(){

    if(Auth::user()->hasrole('admin')){
        $categories = Category::all();
        return view('admin.categories.index' , compact('categories'));
        }
    return view('not-authorize');

    }
    
  public function create(){
    if(Auth::user()->hasrole('admin')){
    return view('admin.categories.create');

    }

    return view('not-authorize');
}
public function store(Request $request){
    if(Auth::user()->hasrole('admin')){
        Category::create([
            'name' => $request->name
        ]);
        return redirect('/admin/categories');
    }
    return view('not-authorize');

}
public function edit($id){
    if(Auth::user()->hasrole('admin')){
        $category = Category::find($id);
        return view('admin.categories.edit' , compact('category'));

    }
    return view('not-authorize');
}
  public function show($id){
    if(Auth::user()->hasrole('admin')){
        $category = Category::find($id);
        return view('admin.categories.show' , compact('category'));
    }
    return view('not-authorize');

}
    public function update(Request $request ,$id){
    if(Auth::user()->hasrole('admin')){
        $getCategory = Category::find($id);
        $getCategory->name = $request->name;
        $getCategory->save();
        return redirect('/categories');
    }
        return view('not-authorize');
    }
    public function delete($id){
        if(Auth::user()->hasrole('admin')){
            Category::find($id)->delete();
            return redirect('/categories');
        }
        return view('not-authorize');


    }
}
