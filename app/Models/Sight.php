<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sight extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    const TITLE = 'Достопримечательность';
    const TABLE = 'sights';

    protected $fillable = [
        'city_id',
        'name',
        'description',
        'slug',
    ];

    public function articles()
    {
        return $this->morphMany(Article::class, 'articleable');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
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
