<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentCity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'city_id',
        'comment_body',
    ];

}
