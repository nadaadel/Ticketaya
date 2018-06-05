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
        $names=[];
        $replies=Comment::find($id)->replies;
        foreach ($replies as $reply){
            $name=$reply->user->name;
            $names[]=$name;


        }
        
       
        return response()->json(['replies' => $replies ,'names' => $names]);
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
