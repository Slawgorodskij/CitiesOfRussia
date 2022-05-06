<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Sight;
use App\Models\CommentCity;
use App\Models\CommentSight;
use Auth;

class AccountController extends Controller
{
    public function index()
    {

        if (Auth::check()){
            $user_id = Auth::user()->id;
            $user_name = Auth::user()->name;
            $user_email = Auth::user()->email;
        }
        else{
            return view('auth/login');  // зарегистрироваться сначала
        }

        $user_id = 1;   // для отладки

        // Выбор города по последней дате комментария

        $citycomment = CommentCity::select(['city_id', 'comment_body', 'created_at'])
        ->where('user_id', $user_id)
        ->take(2)
        ->get();
        $city_id = $citycomment->sortByDesc('created_at')->pluck('city_id')->first();

        $city = City::select(['name'])
        ->where('id', $city_id)
        ->pluck('name')
        ->first();

        // Выбор достопримечательности по последней дате комментария

        $sightcomment = CommentSight::select(['sight_id', 'comment_body', 'created_at'])
        ->where('user_id', $user_id)
        ->take(3)
        ->get();

        $sight_id = $sightcomment->sortByDesc('created_at')->pluck('sight_id')->first();

        //dump($sight_id);

        $sight_id = 1; // для отладки

        $sight = Sight::select(['name'])
        ->where('id', $sight_id)
        ->get();

        return view('account', [
            'name' => $user_name,
            'email' => $user_email,
            'city' => $city,
            'citycomment' => $citycomment,
            'sight' => $sight,
            'sightcomment' => $sightcomment,
            ]);
    }
}
