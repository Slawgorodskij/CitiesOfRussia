<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
        //dd($request);
        $commentsDB = Comment::orderByRaw("RAND()")->take(4)->get();
        $comments = app(TripService::class)->tripComment($commentsDB);
        return view('jointTrip', [
            'comments' => $comments,
        ]);
    }
}
