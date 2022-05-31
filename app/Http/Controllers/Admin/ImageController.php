<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
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
        return view(
            'admin.images.editor',
            ['relations' => app(ModelService::class)->getRelationsByMethod("images", ['id', 'name'])]
        );
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

        try {
            $imageable = app(ModelService::class)
                ->getModelNameSpaceByTitle($validated['imageable_type'])
                ::find($validated['imageable_id']);

            $images = [];
            for ($i = 0, $files = $validated['file']; $i < count($files); $i++) {
                $images[] = new Image([
                    'name' => '/../storage/' . app(UploadService::class)->saveFile($files[$i], 'images'),
                    'description' => $validated['description'][$i],
                ]);
            }
            $imageable->images()->saveMany($images);

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
