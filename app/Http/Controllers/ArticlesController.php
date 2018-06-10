<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Article;
class ArticlesController extends Controller
{
      public function index(){
        $articles = Article::all();
        return view('admin.articles.index' , compact('articles'));
      }
}
