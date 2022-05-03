<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Services\UploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImageFormRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::simplePaginate(10);
        return view('admin.images.index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.images.editor');
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
        $validated['imageable_type'] = match ($validated['imageable_type']) {
            class_basename(City::class) => City::class,
            class_basename(Sight::class) => Sight::class,
        };
        $validated['image_body'] = app(UploadService::class)->saveText(
            $validated['image_body'],
            'images',
        );
        $created = Image::create($validated);

        if ($created) {
            return to_route('admin.images.index');
        }

        return back()->withInput();
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
