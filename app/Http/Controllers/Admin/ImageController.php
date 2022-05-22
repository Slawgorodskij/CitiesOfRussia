<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Image;
use App\Models\Sight;
use App\Services\UploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImageFormRequest;
use App\Services\ModelService;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.images.index', [
            'data' => Image::get([
                'id',
                'name',
                'created_at',
            ]),
            'options' => [
                'url' => "/admin/images/",
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
                'deleteConfirmation' => "Подтвердите удаление фото с #ID",
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
        $relations = [];
        foreach (app(ModelService::class)->getModelsByMethod("images") as $modelName) {
            if (app(ModelService::class)->checkModelHasColumn($modelName, 'name')) { //костыль
                $relations[$modelName::TITLE] = $modelName::all(['id', 'name'])->toArray();
            }
        };
        return view('admin.images.editor', ['relations' => $relations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ImageFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageFormRequest $request)
    {
        $validated = $request->validated();
        $validated['imageable_type'] = app(ModelService::class)->getModelByTitle($validated['imageable_type']);

        try {
            for ($i = 0, $files = $validated['file']; $i < count($files); $i++) {
                Image::create([
                    'name' => '/../storage/' . app(UploadService::class)->saveFile($files[$i], 'images'),
                    'description' => $validated['description'][$i],
                    'imageable_id' => $validated['imageable_id'],
                    'imageable_type' => $validated['imageable_type'],
                ]);
            }
            return to_route('admin.images.index');
        } catch (\Exception $e) {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        try {
            $image->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Image error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
