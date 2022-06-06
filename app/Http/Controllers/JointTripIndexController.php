<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChoiceOfCitiesFormRequest;
use App\Models\Comment;
use App\Models\Driver;
use App\Services\TripService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JointTripIndexController extends Controller
{

    /**
     * Update the specified resource in storage.
     * @param ChoiceOfCitiesFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(ChoiceOfCitiesFormRequest $request)
    {
        $departureCity = '';
        $dataTrips = app(TripService::class)->tripCity($request);
        $commentsDB = Comment::orderByRaw("RAND()")->take(4)->get();
        $comments = app(TripService::class)->tripComment($commentsDB);
        $cityOfArrival = $request->city_of_arrival_name;
        $userId = Auth::user()->id;

        if (isset($request->departure_city_name)) {
            $departureCity = $request->departure_city_name;
        }

        return view('jointTrip', ['comments' => $comments,
            'dataTrips' => $dataTrips,
            'cityOfArrival' => $cityOfArrival,
            'departureCity' => $departureCity,
            'userId' => $userId,
        ]);
    }


}
