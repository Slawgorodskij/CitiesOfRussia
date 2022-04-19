<?php

namespace App\Http\Controllers;

use App\Models\City;

class HomeController extends Controller
{
    public function index()
    {
        $city = City::with('images')->offset(request('offset'))->take(6)->get();
        return response()->json($city);
    }

}
