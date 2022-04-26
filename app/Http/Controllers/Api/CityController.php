<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        $city = City::with('images')->offset(request('offset'))->take(6)->get();
        return response()->json($city);
    }

}
