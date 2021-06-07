<?php

namespace App\Traits;

trait ResponsesTrait
{
    public function success($data,$name=null)
    {
        return response()->json([
            'success' => True,
            $name => $data
        ]);
    }

    public function failed($data,$name=null)
    {
        return response()->json([
            'success' => False,
            $name => $data
        ]);
    }

    public function nameLang($name, $name_en, $lang)
    {
        return $title = ($lang == "en") ? $name_en : $name;
    }
}
