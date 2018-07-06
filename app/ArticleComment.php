<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;
use App\User;
use App\ArticleCommentReply;

class ArticleComment extends Model
{
    protected $fillable = [
        'body','user_id','article_id'
    ];
    public function user(){
        return $this->belongsTo(User::class ,'user_id','id');
    }
    public function article(){
        return $this->belongsTo(Article::class,'article_id','id');
    }
    public function replies(){
        return $this->hasMany(ArticleCommentReply::class);
    }

}
