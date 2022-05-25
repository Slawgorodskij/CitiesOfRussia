<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Services\ModelService;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentFormRequest $request)
    {
        $validated = $request->validated();
        $validated['commentable_type'] = app(ModelService::class)->getModelByTitle($validated['commentable_type']);
        $validated['user_id'] = Auth::user()->id;
        $created = Comment::create($validated);

        if ($created) {
            return back();
        }

        return back()->withInput();
    }
}
