<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'article_body',
        'articleable_id',
        'articleable_type',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'article_images', 'article_id', 'image_id');
    }

    public function articleable()
    {
        return $this->morphTo();
    }
}
