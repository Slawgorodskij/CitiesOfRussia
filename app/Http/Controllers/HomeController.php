<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\City;
use App\Models\Image;
use App\Models\Sight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function city()
    {
        $city = City::with('images')->offset(request('offset'))->take(6)->get();
        return response()->json($city);
    }

}
