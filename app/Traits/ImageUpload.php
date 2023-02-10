<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageUpload
{

    public function uploadImage($file)
    {
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/images/', $filename);
        return $filename;
    }

    public function deleteImage($file)
    {
        $path = 'public/images/' . $file;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
