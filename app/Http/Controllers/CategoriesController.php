<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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
    return view('admin.categories.create');

}
public function store(Request $request){
    Category::create([
        'name' => $request->name
    ]);
    return redirect('/admin/categories');
}
public function edit($id){
    $category = Category::find($id);
    return view('admin.categories.edit' , compact('category'));

}
  public function show($id){
    $category = Category::find($id);
    return view('admin.categories.show' , compact('category'));
}
    public function update(Request $request ,$id){
        $getCategory = Category::find($id);
        $getCategory->name = $request->name;
        $getCategory->save();
        return redirect('/admin/categories');
    }
    public function delete($id){
        Category::find($id)->delete();
        return redirect('/admin/categories');
    }
}
