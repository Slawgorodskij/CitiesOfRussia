<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Article
 * @mixin \Eloquent
 */

class Article extends Model
{
    use HasFactory, SoftDeletes;

    // временная константа, позже поменяю
    public const PATH = '/home/voodoo/www/CitiesOfRussia/storage/app/';


    protected $fillable = [
        'title',
        'description',
        'user_id',
        'city_id',
        'category_id',
        'slug'
    ];


    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getText(int $id){
        return file_get_contents(Article::PATH . Article::find($id)->file->path);
    }
}
