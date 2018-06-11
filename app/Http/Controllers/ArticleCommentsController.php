<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleComment;
use Auth;
use App\User;

class ArticleCommentsController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'body'=>'required',
            'user_id' => 'exists:users,id',
            'article_id' => 'exists:articles,id',
        ]);
        if(Auth::check()){
        ArticleComment::create([
            'body' => $request->body,
            'user_id'=>Auth::user()->id,
            'article_id'=>$request->article_id
        ]);
        return redirect('/articles/'.$request->article_id);
        }
    }

}
