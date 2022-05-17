<?php

namespace App\Services;

use App\Models\City;
use App\Models\Profile;
use App\Models\Sight;
use App\Models\Trip;
use App\Models\User;

class TripService
{
    private function dataUser($userId)
    {
        return Profile::where('user_id', $userId)->first();
    }

    private function dataObject($commentableType, $commentableId)
    {
        return sprintf(
            '%s : %s',
            match ($commentableType) {
                City::class => 'О городе',
                Sight::class => 'О достопримечательности',
                User::class => 'О пользователе',
            },
            $commentableType::find($commentableId)->name,
        );
    }

    private function dataCity($cityId)
    {
        return Trip::where('city_of_arrival', $cityId)->get();
    }

    private function dataTwoCity($departureCity, $cityArrivalId)
    {
        return Trip::where('departure_city', $departureCity)
            ->where('city_of_arrival', $cityArrivalId)
            ->get();
    }

    private function cityName($cityId)
    {
        return (City::find($cityId))->name;
    }

    public function tripComment($commentsDB)
    {
        $comments = [];
        foreach ($commentsDB as $commentItem) {
            $user = self::dataUser($commentItem->user_id);
            $comment['comment_body'] = $commentItem->comment_body;
            $comment['firstname'] = $user->firstname;
            $comment['lastname'] = $user->lastname;
            $comment['object'] = self::dataObject($commentItem->commentable_type, $commentItem->commentable_id);
            $comments[] = $comment;
        }
        return $comments;
    }

    public function tripCity($dataRequest)
    {

        $dataTrips = [];

        if (!$dataRequest->departure_city) {
            $trips = $this->dataCity($dataRequest->city_of_arrival);
        }

        if ($dataRequest->departure_city) {
            $trips = $this->dataTwoCity($dataRequest->departure_city, $dataRequest->city_of_arrival);

            if (empty($trips[0])) {
                $trips = $this->dataCity($dataRequest->departure_city);
            }
        }

        foreach ($trips as $trip) {
            if ($trip->driver) {
                $user = $this->dataUser($trip->driver);
                $dataTrip['driverFirstname'] = $user->firstname;
                $dataTrip['driverLastname'] = $user->lastname;
            }
            if ($trip->passenger_first) {
                $user = $this->dataUser($trip->passenger_first);
                $dataTrip['passengerFirstFirstname'] = $user->firstname;
                $dataTrip['passengerFirstLastname'] = $user->lastname;
            }
            if ($trip->passenger_two) {
                $user = $this->dataUser($trip->passenger_two);
                $dataTrip['passengerTwoFirstname'] = $user->firstname;
                $dataTrip['passengerTwoLastname'] = $user->lastname;
            }
            if ($trip->passenger_three) {
                $user = $this->dataUser($trip->passenger_three);
                $dataTrip['passengerThreeFirstname'] = $user->firstname;
                $dataTrip['passengerThreeLastname'] = $user->lastname;
            }
            if ($trip->departure_city) {
                $dataTrip['departureCity'] = $this->cityName($trip->departure_city);
            }
            if ($trip->city_of_arrival) {
                $dataTrip['cityOfArrival'] = $this->cityName($trip->city_of_arrival);
            }

            $dataTrips[] = $dataTrip;
        }
        return $dataTrips;
    }
}
