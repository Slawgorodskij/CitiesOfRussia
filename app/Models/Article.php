<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image_id',
        'user_id',
        'title',
        'description',
        'article_body',
    ];

    public function comments()
    {
        return $this->hasMany(CommentArticle::class, 'article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //TODO здесь надо экспериментировать
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
