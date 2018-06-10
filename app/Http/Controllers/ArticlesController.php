<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;
class ArticlesController extends Controller
{
      public function index(){
        $articles = Article::all();
        return view('admin.articles.index' , compact('articles'));
      }
}
