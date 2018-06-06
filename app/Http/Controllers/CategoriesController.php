<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function index(){
     $categories = Category::all();
     return view('admin.categories.index' , compact('categories'));
    }
}   
