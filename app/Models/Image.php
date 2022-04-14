<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'image_id');
    }

    public function sight()
    {
        return $this->belongsTo(Sight::class, 'image_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'image_id');
    }

}
