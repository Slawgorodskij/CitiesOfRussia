<?php

namespace App\Services;

use App\Models\City;
use App\Models\Profile;
use App\Models\Sight;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Facades\Date;

class AccountTripService
{
    private function dataBaseTrip($userId)
    {
        return Trip::where('driver', $userId)
            ->orWhere('passenger_first', $userId)
            ->orWhere('passenger_two', $userId)
            ->orWhere('passenger_three', $userId)
            ->get();
    }

    private function cityName($cityId)
    {
        return (City::find($cityId))->name;
    }


    private function creatingAnArray($trips, $userId)
    {

        foreach ($trips as $trip) {
            $dataTrip['trip'] = $trip;
            $dataTrip['departureCity'] = $this->cityName($trip->departure_city);
            $dataTrip['cityOfArrival'] = $this->cityName($trip->city_of_arrival);
            $dataTrip['start'] = $trip->start;
            $dataTrip['finish'] = $trip->finish;
            $dataTrip['roles'] = [];
            if ($trip->driver === $userId) {
                $dataTrip['roles'][] = 'водитель';
            }
            if ($trip->passenger_first === $userId) {
                $dataTrip['roles'][] = 'первый пассажир';
            }
            if ($trip->passenger_two === $userId) {
                $dataTrip['roles'][] = 'второй пассажир';
            }
            if ($trip->passenger_three === $userId) {
                $dataTrip['roles'][] = 'третий пассажир';
            }
            $dataTrips[] = $dataTrip;
        }

        return $dataTrips;
    }

    private function currentTrips($trips, $userId)
    {
        $arrayTrips = $this->creatingAnArray($trips, $userId);
        $currentTrips = [];
        foreach ($arrayTrips as $trip) {
            if ($trip['finish'] > date('Y-m-d')) {
                $currentTrips[] = $trip;
            }
        }

        return $currentTrips;
    }

    private function archiveTrips($trips, $userId)
    {
        $arrayTrips = $this->creatingAnArray($trips, $userId);
        $archiveTrips = [];
        foreach ($arrayTrips as $trip) {
            if ($trip['finish'] < date('Y-m-d')) {
                $archiveTrips[] = $trip;
            }
        }

        return $archiveTrips;
    }

    public function myArchiveTravel($userId)
    {
        $trips = $this->dataBaseTrip($userId);

        return $this->archiveTrips($trips, $userId);
    }

    public function myCurrentTravel($userId)
    {
        $trips = $this->dataBaseTrip($userId);

        return $this->currentTrips($trips, $userId);
    }
}
