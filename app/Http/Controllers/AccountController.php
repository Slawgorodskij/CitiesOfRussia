<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Sight;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user = User::find(1);   // для отладки

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

        return view('account', [
            'user' => $user,
            'cityComments' => $cityComments,
            'sightComments' => $sightComments,
        ]);
    }
}
