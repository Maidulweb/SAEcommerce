<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;
trait ProductImageTrait{
    public function productImageUpload(Request $request, $file, $path){
           if($request->hasFile($file)){
            $image = $request->$file;
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path($path), $imageName);
            return $path.'/'.$imageName;
           }
    }

    public function productImageUpdate(Request $request, $file, $path, $oldImage=null){
        if($request->hasFile($file)){
            if(File::exists(public_path($oldImage))){
                File::delete(public_path($oldImage));
            }
            $image=$request->$file;
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path($path), $imageName);
            return $path.'/'.$imageName;
        }
    }

    public function productImageDelete($oldImage){
      
            if(File::exists(public_path($oldImage))){
                File::delete(public_path($oldImage));
            }
        
    }
}