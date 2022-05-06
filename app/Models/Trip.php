<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver',
        'passenger_first',
        'passenger_two',
        'passenger_three',
        'departure_city',
        'city_of_arrival',
        'start',
        'finish',
    ];
}
