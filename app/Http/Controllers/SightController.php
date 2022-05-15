<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Profile;
use App\Models\Sight;

class SightController extends Controller
{
    public function index($citySlug, $sightSlug)
    {
        $city = City::with('sights')->where('slug', $citySlug)
            ->first();
        $sight = Sight::with('images', 'articles')->where('slug', $sightSlug)
            ->first();

        $arrayComments = [];

        foreach ($sight->comments as $commentItem) {
            $user = Profile::find($commentItem->user_id);
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
            'citySlug' => $city->slug,
        ]);
    }
}
