<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $fillable = [
        'path',
        'fileable_id',
        'fileable_type',
    ];

    public $timestamps = false;

    public function fileable()
    {
        return $this->morphTo();
    }

    public static function setText(string $path, string $text): void{
        Storage::put($path, $text);
    }
}
