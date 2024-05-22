<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait ImageUploadTrait {
    public function imageUpload(Request $request, $file, $path){
        if($request->hasFile($file)){   
            $image = $request->$file;
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path($path),$imageName);
            return $path.'/'.$imageName;
        }
    }
}