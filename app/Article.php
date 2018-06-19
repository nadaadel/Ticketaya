<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\ArticleCommentReply;
use App\ArticleComment;


class Article extends Model
{
    protected $fillable = ['title', 'description' ,'photo', 'category_id' , 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(ArticleComment::class)->orderBy('id', 'desc');;
    }
    public function replies(){
        return $this->hasMany(ArticleCommentReply::class)->orderBy('id', 'desc');;
    }
    public function likes(){
        return $this->belongsToMany('App\User','article_user');

    }
}
