<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    const TITLE = 'Профиль';
    const TABLE = 'profiles';

    protected $fillable = [
        'user_id',
        'lastname',
        'firstname',
        'patronymic',
        'date_of_birth',
    ];

}
