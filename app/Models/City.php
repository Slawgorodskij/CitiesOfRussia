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

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentCity::class, 'city_id');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
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
