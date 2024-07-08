<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Storage;

trait HandlesImages
{
    private function handleImageUpload($request, $model, $directory): void
    {
        Storage::makeDirectory($directory);
        $imagePath = $request->file('image')->store($directory);
        $model->image = Storage::url($imagePath);
        $model->save();
    }

    private function deleteImage($imagePath): void
    {
        $oldImagePath = str_replace('/storage', 'public', $imagePath);
        if (Storage::exists($oldImagePath)) {
            Storage::delete($oldImagePath);
        }
    }
}
