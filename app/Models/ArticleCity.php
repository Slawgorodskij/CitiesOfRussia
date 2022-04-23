<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'city_id',
    ];
}
