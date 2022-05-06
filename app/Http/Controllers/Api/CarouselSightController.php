<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Models\Sight;

class CarouselSightController extends Controller
{
    public function index($id)
    {
        $sight = Sight::find($id);
        return response()->json($sight->images);
    }

}
