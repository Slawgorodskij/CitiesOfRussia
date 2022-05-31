<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Trip;
use App\Models\User;
use App\Models\Sight;
use App\Models\Comment;
use App\Models\Driver;
use App\Services\AccountTripService;
use Illuminate\Support\Facades\Auth;
use App\Services\ModelService;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $cityComments = [];

        foreach (Comment::select('commentable_id', 'comment_body', 'created_at')
                     ->where('user_id', $user->id)
                     ->where('commentable_type', City::class)
                     ->orderByDesc('created_at')
                     ->take(2)
                     ->get() as $comment) {
            if (array_key_exists($comment->commentable_id, $cityComments)) {
                $cityComments[$comment->commentable_id]['comments'][] = $comment;
            } else {
                $cityComments[$comment->commentable_id] = [
                    'city' => City::find($comment->commentable_id),
                    'comments' => [$comment],
                ];
            }
        }

        $sightComments = [];

        foreach (Comment::select('commentable_id', 'comment_body', 'created_at')
                     ->where('user_id', $user->id)
                     ->where('commentable_type', Sight::class)
                     ->orderByDesc('created_at')
                     ->take(2)
                     ->get() as $comment) {
            if (array_key_exists($comment->commentable_id, $sightComments)) {
                $sightComments[$comment->commentable_id]['comments'][] = $comment;
            } else {
                $sightComments[$comment->commentable_id] = [
                    'sight' => Sight::find($comment->commentable_id),
                    'comments' => [$comment],
                ];
            }
        }

        $commentRelations = app(ModelService::class)->getRelationsByMethod("comments", ['id', 'name']);

        $comments = Comment::orderByRaw("RAND()")
            ->where('commentable_type', User::class)
            ->take(4)
            ->get();

        $carinfo = Driver::select(['car', 'registration_number'])
            ->where('user_id', $user->id)
            ->first();

        return view('account', [
            'user' => $user,
            'cityComments' => $cityComments,
            'sightComments' => $sightComments,
            'commentRelations' => $commentRelations,
            'comments' => $comments,
            'carinfo' => $carinfo,
        ]);
    }

    public function trip()
    {
        $user = Auth::user();

        $dataCurrentTrips = app(AccountTripService::class)->myCurrentTravel($user->id);
        $dataArchiveTrips = app(AccountTripService::class)->myArchiveTravel($user->id);

        return view('accountTrip', [
            'user' => $user,
            'dataCurrentTrips' => $dataCurrentTrips,
            'dataArchiveTrips' => $dataArchiveTrips,
        ]);
    }
}
