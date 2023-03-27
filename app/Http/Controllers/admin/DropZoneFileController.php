<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DropZoneFileController extends Controller
{
    public function uploadTemporaryImages(Request $request, $type)
    {
        $request->validate([
            'file' => ['image', 'mimes:jpg,png,jpeg', 'max:3072']
        ]);
        $path = storage_path('temporary/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = $type . '-'. uniqid('', true) . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function removeImage(Request $request)
    {
        if ($request->id !== null) {
            Media::where('id', $request->id)->delete();
        }

        if (File::exists(storage_path('temporary/uploads/'.$request->filename ))) {
            File::delete(storage_path('temporary/uploads/'.$request->filename ));
        }

        return response()->json(true);

    }
}
