<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function index($slug)
    {
        $arrayComments = [];
        $departureCityName = '';

        $city = City::with('images', 'articles', 'sights', 'comments')
            ->where('slug', $slug)
            ->first();

        if (Auth::user()) {
            $profile = Auth::user()->profiles;
            $departureCityName = $profile[0]['city'];
        }

        foreach ($city->comments as $commentItem) {
            $user = Profile::where('user_id', $commentItem->user_id)->first();
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
            'cityId' => $city->id,
            'cityArrivalName' => $city->name,
            'departureCityName' => $departureCityName,
            'citySlug' => $city->slug,
        ]);
    }
}
