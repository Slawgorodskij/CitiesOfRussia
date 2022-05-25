<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Comment;
use App\Models\Driver;
use App\Models\Profile;
use App\Models\Trip;
use App\Models\User;
use App\Services\TripService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JointTripController extends Controller
{

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departureCity = '';
        $tripRole = '';
        $dataTrips = app(TripService::class)->tripCity($request);
        $commentsDB = Comment::orderByRaw("RAND()")->take(4)->get();
        $comments = app(TripService::class)->tripComment($commentsDB);
        $cityOfArrival = $request->city_of_arrival_name;
        $userId = Auth::user()->id;

        if (isset($request->departure_city_name)) {
            $departureCity = $request->departure_city_name;
        }
        if (isset($request->trip_role)) {
            $tripRole = $request->trip_role;
        }
        if (!isset($request->trip_role)) {
            $driver = Driver::where('user_id', $userId);
            if (isset($driver->document_verification) && $driver->document_verification === 'checked') {
                $tripRole = 'Водитель';
            } else {
                $tripRole = 'Пассажир';
            }
        }
        //dd($dataTrips);
        return view('jointTrip', ['comments' => $comments,
            'dataTrips' => $dataTrips,
            'cityOfArrival' => $cityOfArrival,
            'departureCity' => $departureCity,
            'tripRole' => $tripRole,
            'userId' => $userId,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        $trip = Trip::create($request->validated());

        return to_route('joint-trip');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Trip $trip
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Trip $trip)
    {
        $trip->update($request->validated());
        return to_route('joint-trip');
    }
}
