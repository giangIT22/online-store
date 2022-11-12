<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait StoreImageTrait
{
    public function uploadImage($request, $fieldName, $folderUpload, $code = '')
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;//get info of file
            $fileNameOrigin = $code . date('YmdHi') . $file->getClientOriginalName();//get name file and create new fileName
            $filePath = $request->file($fieldName)->storeAs('public/'. $folderUpload, $fileNameOrigin); //upload file
                                                                                            // and return where upload that file
            $data = [
                // 'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath), //return path on folder public/storage
            ];

            return $data;
        }

        return null;
    }

    public function uploadImageMultiple($file, $folderUpload)
    {
        $fileNameOrigin = date('YmdHi') . $file->getClientOriginalName();//get name file and set filename
        $filePath = $file->storeAs('public/'. $folderUpload, $fileNameOrigin); //upload file
                                                                                        // and return where upload that file
        $data = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath), //return path on folder public/storage
        ];

        return $data;
    }
}