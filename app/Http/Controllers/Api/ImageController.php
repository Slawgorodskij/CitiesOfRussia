<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UploadService;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $fileName = app(UploadService::class)->saveFile($request->file('file'), 'images');
        return response()->json(['location' => "/../storage/$fileName"]);
    }
}
