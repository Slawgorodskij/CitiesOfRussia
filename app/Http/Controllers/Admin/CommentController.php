<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.comments.index', [
            'data' => Comment::with('user')->get([ //:id,name
                'id',
                'comment_body',
                'created_at',
                'user_id',
            ]),
            'options' => [
                'url' => "/admin/comments/",
                'fields' => [
                    [
                        'id' => 'id',
                        'name' => '#ID',
                    ],
                    [
                        'id' => 'comment_body',
                        'name' => 'Комментарий',
                    ],
                    [
                        'id' => 'created_at',
                        'name' => 'Дата добавления',
                    ],
                ],
                'filterFields' => [
                    [
                        'id' => "user",
                        'name' => 'Пользователь',
                    ],
                ],
                'deleteConfirmation' => "Подтвердите удаление комментария с #ID",
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Comment error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
