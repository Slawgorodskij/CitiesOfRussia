<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Profile;
use App\Models\User;

class CityController extends Controller
{
    public function index($slug)
    {
        $city = City::with('images', 'articles', 'sights', 'comments')
            ->where('slug', $slug)
            ->first();
        $arrayComments = [];

        foreach ($city->comments as $commentItem) {
            $user = Profile::find($commentItem->user_id);
            $comment['comment_body'] = $commentItem->comment_body;
            $comment['firstname'] = $user->firstname;
            $comment['lastname'] = $user->lastname;
            $arrayComments[] = $comment;
        }

        $comments = array_slice($arrayComments, -5);

        return view('destination', [
            'destination_data' => $city,
            'sights' => $city->sights,
            'comments' => $comments,
            'citySlug' => $city->slug,
        ]);
    }
}
