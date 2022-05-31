<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class JointTripUpdateController extends Controller
{
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

        $trip = Trip::find($id);

        if (is_null($trip->driver)
            && is_null($trip->passenger_first)
            && is_null($trip->passenger_two)
            && is_null($trip->passenger_three)
        ) {
            $trip->delete();
        }

        return to_route('account.trip');
    }
}
