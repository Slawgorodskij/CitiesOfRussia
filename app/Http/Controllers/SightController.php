<?php

namespace App\Http\Controllers;

use App\Models\Sight;

class SightController extends Controller
{
    public function index($slug)
    {
        $sight = Sight::with('images', 'articles')->where('slug', $slug)
            ->first();

        return view('destination', [
            'destination_data' => $sight,
        ]);
    }
}
