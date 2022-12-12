<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');
        $imgName = Str::uuid() . "." . $image->extension();
        $imgPath = public_path('uploads') . '/' . $imgName;
        $imgServer = Image::make($image);
        $imgServer->fit(1000, 1000);
        $imgServer->save($imgPath);
        return response()->json([
            'image' => $imgName
        ]);
    }
}
