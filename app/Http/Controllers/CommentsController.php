<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Reply;
use Auth;

class CommentsController extends Controller
{
    public function store(Request $request){
        Comment::create([
            'body' => $request->body,
            'user_id'=>Auth::user()->id,
            'ticket_id'=>$request->ticket_id
        ]);
        return redirect('/tickets/'.$request->ticket_id);
    }

    public function delete($id){
        $comment=Comment::find($id);
       
       // dd($replies);
        if(Auth::check()&&(Auth::user()->id==$comment->user->id||Auth::user()->hasRole('admin')||Auth::user()->id==$comment->ticket->user_id)){
            $comment->delete();
            $replies=Reply::where('comment_id','=',$id)->delete();
            return response()->json(['status' => 'success']);

        }
        else{
            return view('notfound');
        }
    }
}
