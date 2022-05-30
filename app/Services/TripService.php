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

    private function userName($userId)
    {
        return User::find($userId);
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

    private function cityPhoto($cityId)
    {
        return ((City::find($cityId))->images)[0];
    }

    private function creatingAnArray($trips)
    {
        $dataTrips = [];
        foreach ($trips as $trip) {
            $dataTrip['driverFirstname'] = '';
            $dataTrip['driverLastname'] = '';
            $dataTrip['driverName'] = '';
            $dataTrip['passengerFirstFirstname'] = '';
            $dataTrip['passengerFirstLastname'] = '';
            $dataTrip['passengerFirstName'] = '';
            $dataTrip['passengerTwoFirstname'] = '';
            $dataTrip['passengerTwoLastname'] = '';
            $dataTrip['passengerTwoName'] = '';
            $dataTrip['passengerThreeFirstname'] = '';
            $dataTrip['passengerThreeLastname'] = '';
            $dataTrip['passengerThreeName'] = '';
            $dataTrip['trip'] = $trip;


            if ($trip->driver) {
                $driver = $this->dataUser($trip->driver);
                $userName = $this->userName($trip->driver)->name;
                $dataTrip['driverFirstname'] = $driver->firstname ?? $userName;
                $dataTrip['driverLastname'] = $driver->lastname ?? '';
                $dataTrip['driverName'] = $userName;
            }

            if ($trip->passenger_first) {
                $user = $this->dataUser($trip->passenger_first);
                $userName = $this->userName($trip->passenger_first)->name;
                $dataTrip['passengerFirstFirstname'] = $user->firstname ?? $userName;
                $dataTrip['passengerFirstLastname'] = $user->lastname ?? '';
                $dataTrip['passengerFirstName'] = $userName;
            }

            if ($trip->passenger_two) {
                $user = $this->dataUser($trip->passenger_two);
                $userName = $this->userName($trip->passenger_two)->name;
                $dataTrip['passengerTwoFirstname'] = $user->firstname ?? $userName;
                $dataTrip['passengerTwoLastname'] = $user->lastname ?? '';
                $dataTrip['passengerTwoName'] = $userName;
            }

            if ($trip->passenger_three) {
                $user = $this->dataUser($trip->passenger_three);
                $userName = $this->userName($trip->passenger_three)->name;
                $dataTrip['passengerThreeFirstname'] = $user->firstname ?? $userName;
                $dataTrip['passengerThreeLastname'] = $user->lastname ?? '';
                $dataTrip['passengerThreeName'] = $userName;
            }
            if ($trip->departure_city) {
                $dataTrip['departureCity'] = $this->cityName($trip->departure_city);
            }
            if ($trip->city_of_arrival) {
                $dataTrip['cityOfArrival'] = $this->cityName($trip->city_of_arrival);
                $dataTrip['PhotoCityOfArrival'] = $this->cityPhoto($trip->city_of_arrival)->name;
            }

            $dataTrips[] = $dataTrip;
        }
        return $dataTrips;
    }

    public function tripComment($commentsDB)
    {
        $comments = [];
        foreach ($commentsDB as $commentItem) {
            $user = self::dataUser($commentItem->user_id);
            $comment['comment_body'] = $commentItem->comment_body;
            $comment['firstname'] = 'Иван';
            $comment['lastname'] = 'Петров';
        //    $comment['firstname'] = $user->firstname;
        //    $comment['lastname'] = $user->lastname;
            $comment['object'] = self::dataObject($commentItem->commentable_type, $commentItem->commentable_id);
            $comments[] = $comment;
        }
        return $comments;
    }

    public function tripCity($dataRequest)
    {
        if (!$dataRequest->departure_city) {
            $trips = $this->dataCity($dataRequest->city_of_arrival);
        }

        if ($dataRequest->departure_city) {
            $trips = $this->dataTwoCity($dataRequest->departure_city, $dataRequest->city_of_arrival);

            if (empty($trips[0])) {
                $trips = $this->dataCity($dataRequest->departure_city);
            }
        }

        return $this->creatingAnArray($trips);
    }

    public function myTravel($userId)
    {
        $trips = Trip::where('driver', $userId)
            ->orWhere('passenger_first', $userId)
            ->orWhere('passenger_two', $userId)
            ->orWhere('passenger_three', $userId)
            ->get();

        return $this->creatingAnArray($trips);
    }
}
