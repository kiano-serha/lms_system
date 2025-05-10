<?php

namespace App\Servies;

use Illuminate\Support\Facades\File;

class GeneralServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function upload($path = './uploads', $file = 'image'): ?string
    {
        File::ensureDirectoryExists($path);

        if (request()->hasFile($file)) {
            $fileWithExt = request()->file($file)->getClientOriginalName();
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
            $extension = request()->file($file)->getClientOriginalExtension();
            $fileNameToStore = $filename . '-' . time() . '.' . $extension;
            $path = request()->file($file)->storeAs($path, $fileNameToStore);
            return asset($path);
        }
        return null;
    }
}
