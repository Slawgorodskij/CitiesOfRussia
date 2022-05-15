<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\TripService;

class TripController extends Controller
{
    public function index()
    {
        $commentsDB = Comment::orderByRaw("RAND()")->take(4)->get();
        $comments = app(TripService::class)->tripComment($commentsDB);
        return view('trip', [
            'comments' => $comments,
        ]);
    }
}
