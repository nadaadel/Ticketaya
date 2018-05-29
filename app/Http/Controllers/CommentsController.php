<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function store(Request $request){
        Comment::create([
            'body' => $request->body,
            'user_id'=>Auth::user()->id,
            'ticket_id'=>$request->id
        ]);
        return redirect('/tickets');
    }
}
