<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner'=>['required', 'max:2000','image'],
            'type'=>['required', 'max:200'],
            'title'=>['required', 'max:200'],
            'price'=>['required', 'max:200'],
            'button_url'=>['required', 'max:200','url'],
            'serial'=>['required', 'max:200'],
            'status'=>['required', 'max:200'],
        ]);

        $slider = new Slider();

        $banner = $this->imageUpload($request,'banner', 'uploads');

        $slider->banner = $banner;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->price = $request->price;
        $slider->button_url = $request->button_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        Cache::forget('sliders');

        $notification = [
            'message' => 'Slider created successfully',
            'alert-type' => 'success'
            ];
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);
        
        $banner = $this->imageUpdate($request,'banner', 'uploads', $slider->banner);
    
        $slider->banner = empty(!$banner) ? $banner  : $slider->banner;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->price = $request->price;
        $slider->button_url = $request->button_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        Cache::forget('sliders');
        
        $notification = [
            'message' => 'Updated successfully',
            'alert-type' => 'success'
            ];
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->sliderImageDelete($slider->banner);
        $slider->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Slider item deleted!!!'
        ]);
    }
}
