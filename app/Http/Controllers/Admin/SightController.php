<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sight;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SightFormRequest;

class SightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sights.index', [
            'data' => Sight::with('cities:id,name')->get([
                'id',
                'name',
                'created_at',
                'city_id',
            ]),
            'options' => [
                'url' => "/admin/sights/",
                'fields' => [
                    [
                        'key' => 'id',
                        'name' => '#ID',
                    ],
                    [
                        'key' => 'name',
                        'name' => 'Название',
                    ],
                    [
                        'key' => 'created_at',
                        'name' => 'Дата добавления',
                    ],
                ],
                'filterFields' => [
                    [
                        'key' => "cities",
                        'name' => 'Город',
                    ],
                ],
                'deleteConfirmation' => "Подтвердите удаление достопримечательности с #ID",
                'polymorphic' => [
                    [
                        'key' => 'articleable',
                        'url' => route('admin.articles.create'),
                        'type' => class_basename(Sight::class),
                        'message' => 'Добавить статью',
                    ],
                    [
                        'key' => 'imageable',
                        'url' => route('admin.images.create'),
                        'type' => class_basename(Sight::class),
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
        return view('admin.sights.editor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SightFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SightFormRequest $request)
    {
        // $validated = $request->validated();
        // $created = Sight::create($validated);

        // if ($created) {
        //     return to_route('admin.sights.index');
        // }

        // return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sight $sight
     * @return \Illuminate\Http\Response
     */
    public function edit(Sight $sight)
    {
        return view('admin.sights.editor', [
            'sight' => $sight,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SightFormRequest $request
     * @param Sight $sight
     * @return \Illuminate\Http\Response
     */
    public function update(SightFormRequest $request, Sight $sight)
    {
        // $sight->update($request->validated());
        // return to_route('admin.sights.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sight $sight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sight $sight)
    {
        try {
            $sight->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Sight error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
