<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleComment;
use App\ArticleCommentReply;
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
    public function delete($id){
        $comment=ArticleComment::find($id);
       
       
        if(Auth::check()&&(Auth::user()->id==$comment->user->id||Auth::user()->hasRole('admin')||Auth::user()->id==$comment->article->user_id)){
            $comment->delete();
            $replies=ArticleCommentReply::where('article_comment_id','=',$id)->delete();
            return response()->json(['status' => 'success']);

        }
        else{
            return view('notfound');
        }
    }

}
