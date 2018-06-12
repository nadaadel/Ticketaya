<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleComment;
use Auth;
use App\User;
use App\ArticleCommentReply;

class ArticleCommentRepliesController extends Controller
{
    public function show($id)
    {
        $names=[];
        $replies=ArticleComment::find($id)->replies;
        if($replies !== null){
        foreach ($replies as $reply){
            $name=$reply->user->name;
            $names[]=$name;
        }
    }
        return response()->json(['replies' => $replies ,'names' => $names]);
    }

    public function store(Request $request){
        $request->validate([
            'bodyReply'=>'required',
            'user_id' => 'exists:users,id',
            'comment_id' => 'exists:article_comments,id',
            'article_id' => 'exists:articles,id',
        ]);
        if(Auth::check()){
        $a=ArticleCommentReply::create([
            'body' => $request->bodyReply,
            'user_id'=>Auth::user()->id,
            'article_id'=>$request->article_id,
            'article_comment_id'=>$request->comment_id
        ]);
        return redirect('/articles/'.$request->article_id);
        }
    }
}
