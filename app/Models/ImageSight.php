<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSight extends Model
{
    use HasFactory;

    protected $fillable = [
        'sight_id',
        'image_id',
        'description',
    ];
}
