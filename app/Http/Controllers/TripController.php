<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\TripService;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $commentsDB = Comment::orderByRaw("RAND()")->take(4)->get();
        $comments = app(TripService::class)->tripComment($commentsDB);
        $myTravels = app(TripService::class)->myTravel($userId);
        return view('trip', [
            'comments' => $comments,
            'dataTrips' => $myTravels,
            'userId' => $userId,
        ]);
    }
}
