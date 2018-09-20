<?php

namespace  App\Traits;

use Illuminate\Http\Request;

trait ImageTrait
{
    public function upload(Request $request)
    {
        $file       = $request->file('file');
        $fileName   = $file->getClientOriginalName();
        $request->file('file')->move("images/", $fileName);
        $path = '/images/'.$fileName;
        return $path;
    }
}