<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UploadService;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        dd($request);

        // if (array_key_exists('images', $validated)) {
        //     foreach ($validated['images'] as $image) {
        //         $image = Image::create([
        //             'name' => 'storage/' . app(UploadService::class)->saveFile($image, 'images')
        //         ]);
        //         $created->images()->attach($image);
        //     }
        // }

        $fileName = app(UploadService::class)->saveFile($request->file('file'), 'images');
        return response()->json(['location' => "/storage/$fileName"]);
    }

}
