<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'driving_license',
        'car',
        'registration_number',
        'vehicle_registration_certificate',
        'document_verification',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
