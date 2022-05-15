<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserFormRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'data' => User::get([
                'id',
                'name',
                'created_at',
            ]),
            'options' => [
                'url' => "/admin/users/",
                'fields' => [
                    [
                        'key' => 'id',
                        'name' => '#ID',
                    ],
                    [
                        'key' => 'name',
                        'name' => 'Имя',
                    ],
                    [
                        'key' => 'created_at',
                        'name' => 'Дата добавления',
                    ],
                ],
                'deleteConfirmation' => "Подтвердите удаление пользователя с #ID",
                'polymorphic' => [
                    [
                        'key' => 'imageable',
                        'url' => route('admin.images.create'),
                        'type' => class_basename(User::class),
                        'message' => 'Загрузить фото',
                    ],
                ],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.editor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        // $validated = $request->validated();
        // $created = User::create($validated);

        // if ($created) {
        //     return to_route('admin.users.index');
        // }

        // return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.editor', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserFormRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        // $user->update($request->validated());
        // return to_route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('User error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
