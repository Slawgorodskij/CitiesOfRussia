<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityFormRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cities.index', [
            'data' => City::get([
                'id',
                'name',
                'created_at',
            ]),
            'options' => [
                'url' => "/admin/cities/",
                'fields' => [
                    [
                        'id' => 'id',
                        'name' => '#ID',
                    ],
                    [
                        'id' => 'name',
                        'name' => 'Название',
                    ],
                    [
                        'id' => 'created_at',
                        'name' => 'Дата добавления',
                    ],
                ],
                'deleteConfirmation' => "Подтвердите удаление города с #ID",
                'polymorphic' => [
                    [
                        'id' => 'articleable',
                        'url' => route('admin.articles.create'),
                        'type' => City::TITLE,
                        'message' => 'Добавить статью',
                    ],
                    [
                        'id' => 'imageable',
                        'url' => route('admin.images.create'),
                        'type' => City::TITLE,
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
        return view('admin.cities.editor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CityFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityFormRequest $request)
    {
        $validated = $request->validated();
        $created = City::create($validated);

        if ($created) {
            return to_route('admin.cities.index');
        }

        return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('admin.cities.editor', [
            'city' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityFormRequest $request
     * @param City $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityFormRequest $request, City $city)
    {
        $city->update($request->validated());
        return to_route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try {
            $city->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('City error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
