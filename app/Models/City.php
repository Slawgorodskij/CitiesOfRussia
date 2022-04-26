<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'name',
        'description',
        'slug',
    ];


    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_cities', 'city_id', 'article_id');
    }
    // public function articles()
    // {
    //     return $this->belongsTo(Article::class, 'article_id');
    // }

    public function sights()
    {
        return $this->hasMany(Sight::class, 'city_id');
    }

    public function comments()
    {
        return $this->hasMany(CommentCity::class, 'city_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'city_images', 'city_id', 'image_id');
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
