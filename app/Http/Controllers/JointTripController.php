<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Trip;
use App\Models\User;
use App\Services\TripService;
use Illuminate\Http\Request;

class JointTripController extends Controller
{

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $dataTrips = app(TripService::class)->tripCity($request);
        $commentsDB = Comment::orderByRaw("RAND()")->take(4)->get();
        $comments = app(TripService::class)->tripComment($commentsDB);

        return view('jointTrip', [
            'comments' => $comments,
            'dataTrips' => $dataTrips,
        ]);
    }
}
