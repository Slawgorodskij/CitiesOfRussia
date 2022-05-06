<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Models\CityImage;

class CarouselCityController extends Controller
{
    public function index($id)
    {
        $data = City::find($id);
        return response()->json($data->images);
    }

}
