<?php

namespace App\Http\Controllers;

use App\Models\City;

class CityController extends Controller
{
    public function index($slug)
    {
        $city = City::with('images', 'articles', 'sights')
            ->where('slug', $slug)
            ->first();
        return view('destination', [
            'destination_data' => $city,
            'sights' => $city->sights,
            'citySlug' => $city->slug,
        ]);
    }
}
