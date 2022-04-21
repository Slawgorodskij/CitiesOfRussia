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
        'city_id',
        'name',
        'description',
        'slug',
        'article_id'
    ];

    public function articles()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function comments()
    {
        return $this->hasMany(CommentSight::class, 'sight_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_sights', 'sight_id', 'image_id');
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
