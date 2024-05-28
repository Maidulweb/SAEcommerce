<?php

namespace App\Traits;
use Illuminate\Http\Request;
use File;

trait ImageUploadTrait {
    public function imageUpload(Request $request, $file, $path){
        if($request->hasFile($file)){   
            $image = $request->$file;
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path($path),$imageName);
            return $path.'/'.$imageName;
        }
    }
    
    public function imageUpdate(Request $request, $file, $path, $oldImage=null){
        if($request->hasFile($file)){   
            $image = $request->$file;

            if(File::exists(public_path($oldImage))){
                File::delete(public_path($oldImage));
            }
                
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path($path),$imageName);
            return $path.'/'.$imageName;
        }
    }

    public function sliderImageDelete($path){
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }

    public function brandImageDelete($path){
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}