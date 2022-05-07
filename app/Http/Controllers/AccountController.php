<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Sight;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $user = User::find(1);   // для отладки

        // Выбор города по последней дате комментария

        $citycomment = Comment::select('commentable_id', 'comment_body', 'created_at')
            ->where('user_id', $user->id)
            ->where('commentable_type', City::class)
            ->orderByDesc('created_at')
            ->limit(1)
            ->first();

        $city = City::find($citycomment->commentable_id);

        // Выбор достопримечательности по последней дате комментария

        $sightcomment = Comment::select('commentable_id', 'comment_body', 'created_at')
            ->where('user_id', $user->id)
            ->where('commentable_type', Sight::class)
            ->orderByDesc('created_at')
            ->limit(1)
            ->first();

        $sight = Sight::find($sightcomment->commentable_id);

        return view('account', [
            'name' => $user->name,
            'email' => $user->email,
            'city' => $city,
            'citycomment' => $citycomment,
            'sight' => $sight,
            'sightcomment' => $sightcomment,
        ]);
    }
}
