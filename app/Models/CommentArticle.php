<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentArticle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'article_id',
        'comment_body',
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
