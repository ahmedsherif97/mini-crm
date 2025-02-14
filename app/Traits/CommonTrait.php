<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait CommonTrait
{
    public function uploadFile(string $inputName = 'file', string $folder = '', $validation = 'required|image|mimes:jpeg,jpg,png|max:3000'): string|null
    {
        set_time_limit(3600);
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        ini_set('post_max_size', '250M');
        ini_set('upload_max_filesize', '250M');

        // validate file
        request()->validate([$inputName => $validation]);

        // remove any / char form var
        $path = "/" . trim($folder, '/');

        // check has file
        if (request()->hasFile($inputName)) {

            $file = request()->file($inputName);

            $filename = time() . '.' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();

            //Should use though "storage" to create nested folders if not found
            Storage::disk('uploads')->put($fullPath = "$path/$filename", $file->get());

            // to show full url
            //return Storage::disk('uploads')->url($fullPath);

            //return file directory without domain name for clean store
            return '/uploads' . $fullPath;
        }

        return NULL;
    }

}
