<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Sight;

class SightController extends Controller
{
    public function index($citySlug, $sightSlug)
    {
        $city = City::with('sights')->where('slug', $citySlug)
            ->first();
        $sight = Sight::with('images', 'articles')->where('slug', $sightSlug)
            ->first();

        return view('destination', [
            'destination_data' => $sight,
            'sight' => $city->sight,
            'citySlug'=> $city->citySlug,
            'sightSlug'=>$city->sightSlug,

        ]);
    }
}
