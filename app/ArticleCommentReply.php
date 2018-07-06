<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;
use App\User;
use App\ArticleComment;

class ArticleCommentReply extends Model
{
    protected $fillable = [
        'body','user_id','article_id','article_comment_id'
    ];
    public function user(){
        return $this->belongsTo(User::class  , 'user_id','id');
    }
    public function article(){
        return $this->belongsTo(Article::class, 'article_id','id');
    }
    public function comment(){
        return $this->belongsTo(ArticleComment::class,'article_comment_id','id');
    }
}


