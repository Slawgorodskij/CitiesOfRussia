<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\City;
use App\Models\Image;
use App\Models\Sight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'cities' => City::with('images')
                ->take(6)
                ->get(),
        ]);
    }
}
