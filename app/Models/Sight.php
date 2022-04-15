<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sight extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image_id',
        'city_id',
        'name',
        'description',
        'slug',
    ];

    public function articles()
    {
        return $this->hasMany(ArticleCity::class, 'sight_id');
    }

    public function sights()
    {
        return $this->hasMany(Sight::class, 'sight_id');
    }

    public function comments()
    {
        return $this->hasMany(CommentCity::class, 'sight_id');
    }

    public function like()
    {
        return $this->hasMany(LikeCity::class, 'sight_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'sight_id');
    }
}
