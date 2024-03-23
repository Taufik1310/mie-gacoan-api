<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $extension = $request->file('file')->extension();
        $fileName = date('dmyHis') . '.' . $extension;
        $request->validate([
            'file' => ['required', 'file', 'max:5000']
        ]);
        $path = Storage::putFileAs('public/images', $request->file('file'), $fileName);
        $url = Storage::url($path);
        return response()->json([
            'code' => 200,
            'message' => 'File Berhasil Diunggah',
            'data' => [
                'path' => $path,
                'fileName' => $fileName,
                'url' => $url
            ]
        ]);
    }
}
