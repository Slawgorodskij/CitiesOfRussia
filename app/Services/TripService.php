<?php

namespace App\Services;

use App\Models\City;
use App\Models\Profile;
use App\Models\Sight;
use App\Models\User;

class TripService
{
    public static function tripComment($commentsDB)
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

    private static function dataUser($userId)
    {
        return Profile::find($userId);
    }

    private static function dataObject($commentableType, $commentableId)
    {
        switch ($commentableType){
            case 'App\Models\City':
                $city = City::find($commentableId);
                return "О городе: $city->name";
            case 'App\Models\Sight':
                $sight = Sight::find($commentableId);
                return "О достопримечательности: $sight->name";
            case 'App\Models\User':
                $user = User::find($commentableId);
                return "О пользователе: $user->name";

        }

    }


}
