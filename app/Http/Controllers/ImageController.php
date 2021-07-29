<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request): array
    {
        $file = $request->file('image');
        $name = \Str::random(10);

        $url = \Storage::putFileAs('images', $file, $name . '.' . $file->extension());

        return [
            'url' => env('APP_URL') . '/' . $url
        ];
    }
}
