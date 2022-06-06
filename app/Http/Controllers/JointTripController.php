<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripFormRequest;
use App\Models\City;
use App\Models\Comment;
use App\Models\Driver;
use App\Models\Trip;
use App\Services\TripService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JointTripController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param TripFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripFormRequest $request)
    {
        $validated = $request->validated();
        $validated['departure_city'] = City::where('name', $validated['departure_city'])->first()->id;
        $validated['city_of_arrival'] = City::where('name', $validated['city_of_arrival'])->first()->id;

        Trip::create([
            "departure_city" => $validated['departure_city'],
            "city_of_arrival" => $validated['city_of_arrival'],
            "driver" => $validated['driver'] ?? null,
            "passenger_first" => $validated['passenger_first'] ?? null,
            "passenger_two" => $validated['passenger_two'] ?? null,
            "passenger_three" => $validated['passenger_three'] ?? null,
            "start" => $validated['start'],
            "finish" => $validated['finish'],
        ]);

        return to_route('account.trip');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Trip::find($id)->update($request->validate([
            "driver" => ['nullable', 'integer'],
            "passenger_first" => ['nullable', 'integer'],
            "passenger_two" => ['nullable', 'integer'],
            "passenger_three" => ['nullable', 'integer'],
        ]));
        return to_route('account.trip');
    }

}
