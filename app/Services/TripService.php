<?php

namespace App\Services;

use App\Models\City;
use App\Models\Profile;
use App\Models\Sight;
use App\Models\User;

class TripService
{
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

    private function dataUser($userId)
    {
        return Profile::find($userId);
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


}
