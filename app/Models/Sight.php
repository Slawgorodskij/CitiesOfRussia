<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sight extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
