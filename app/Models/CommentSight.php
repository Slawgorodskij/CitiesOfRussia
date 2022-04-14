<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentSight extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'sight_id',
        'comment_body',
    ];

    public function sight()
    {
        return $this->hasMany(Sight::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
