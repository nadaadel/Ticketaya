<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Auth;
use App\Comment;

class RepliesController extends Controller
{
    public function show($id)
    {
        $replies=Comment::find($id)->replies;
        
       
        return response()->json(['replies' => $replies]);
    }

    public function store(Request $request){
        
        Reply::create([
            'body' => $request->bodyReply,
            'user_id'=>Auth::user()->id,
            'ticket_id'=>$request->ticket_id,
            'comment_id'=>$request->comment_id
        ]);
        return redirect('/tickets/'.$request->ticket_id);
    }
}
