<?php

namespace App\Containers\Product\UI\API\Controllers;


use App\Containers\Product\UI\API\Requests\ImageUploadRequest;
use App\Ship\Parents\Controllers\Controller;

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
