<?php

namespace App\Traits;

trait FileUploadTrait
{
    protected function uploadFile ($file, $location) {
        $file_original_name = $file -> getClientOriginalName();
        $file_original_extension = $file -> getClientOriginalExtension();
        $file_unique_name = time().rand(100,999).'.'.$file_original_extension;
        $new_path = 'uploads/'.$location;
        // SAVING THE IMAGE IN STORAGE
        //$file -> storeAs('public/uploads/'.$location, $file_unique_name);
        //$file_new_name = '/public/storage/uploads/'.$location.'/'.$file_unique_name;
        $folder_path = public_path($new_path);
        $file -> move($folder_path, $file_unique_name);
        //$file_new_name = '/public/storage/uploads/'.$location.'/'.$file_unique_name;
        return $new_path.'/'.$file_unique_name;
    }

}
