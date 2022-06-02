<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Profile;
use App\Models\Sight;
use Illuminate\Support\Facades\Auth;

class SightController extends Controller
{
    public function index($citySlug, $sightSlug)
    {
        $arrayComments = [];

        $city = City::with('sights')->where('slug', $citySlug)
            ->first();
        $sight = Sight::with('images', 'articles')->where('slug', $sightSlug)
            ->first();

        if (Auth::user()) {
            $profile = Auth::user()->profiles;
        }


        foreach ($sight->comments as $commentItem) {
            $user = Profile::where('user_id', $commentItem->user_id)->first();
            $comment['comment_body'] = $commentItem->comment_body;
            $comment['firstname'] = $user->firstname;
            $comment['lastname'] = $user->lastname;
            $arrayComments[] = $comment;
        }

        $comments = array_slice($arrayComments, 0, 5);

        return view('destination', [
            'destination_data' => $sight,
            'sights' => $city->sights,
            'comments' => $comments,
            'cityId' => $city->id,
            'cityArrivalName' => $city->name,
            'departureCityName' => isset($profile[0]) ? $profile[0]['city'] : null,
            'citySlug' => $city->slug,
        ]);
    }
}
