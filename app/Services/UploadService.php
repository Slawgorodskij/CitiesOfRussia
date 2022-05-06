<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function saveFile(UploadedFile $file, ?string $path = 'files', ?string $fileName = null): string
    {
        $fileName = $fileName ? $file->storeAs($path, $fileName, 'public') : $file->store($path, 'public');

        if (!$fileName) {
            throw new \Exception("File wasn't upload");
        }
        return $fileName;
    }

    public function saveText(string $text, ?string $path = 'files', ?string $fileName = null): string
    {
        $fileName = $fileName ?? Str::random(40);

        if (!Storage::put('public/' . $path . '/' . $fileName, $text)) {
            throw new \Exception("File wasn't upload");
        }
        return $fileName;
    }
}
