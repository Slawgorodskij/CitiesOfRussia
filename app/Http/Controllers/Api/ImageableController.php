<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Sight;
use App\Http\Controllers\Controller;

class ImageableController extends Controller
{
    public function index()
    {
        $imageables = [
            class_basename(City::class) => City::all(['id', 'name']),
            class_basename(Sight::class) => Sight::all(['id', 'name']),
        ];
        return response()->json($imageables);
    }
}
