<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ImageUploadTrait;
    public function index(){
        $advertisement_banner_one = Advertisement::where('key', 'advertisement_banner_one')->first();
        $advertisement_banner_two = Advertisement::where('key', 'advertisement_banner_two')->first();
        $advertisement_banner_three = Advertisement::where('key', 'advertisement_banner_three')->first();
        $advertisement_banner_four = Advertisement::where('key', 'advertisement_banner_four')->first();
        return view('admin.advertisement.index', compact('advertisement_banner_one','advertisement_banner_two','advertisement_banner_three','advertisement_banner_four'));
    }

    public function advertisementBannerOne(Request $request){
        $request->validate([
            'banner' => 'image',
            'url' => 'required',
            'status' => 'required',
        ]); 
        $banner = $this->imageUpdate($request,'banner', 'uploads');
        $data = [
            'banner_one' => [
                'url' => $request->url,
                'status' => $request->status == 'on' ? 1 : 0,
            ]
        ];

        if(!empty($banner)){
            $data['banner_one']['banner'] = $banner;
        }else {
            $data['banner_one']['banner'] = $request->banner_empty;
        }

        $value = json_encode($data);

            Advertisement::updateOrCreate(
                ['key' => 'advertisement_banner_one'],
                ['value' => $value]
            );
    
            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Banner one successfully'
            ]);

        
    }

    public function advertisementBannerTwo(Request $request){
        $request->validate([
            'banner' => 'image',
            'banner_img_two' => 'image',
            'url' => 'required',
            'url_two' => 'required',
            'status' => 'required',
            'status_two' => 'required',
        ]); 
        $banner = $this->imageUpdate($request,'banner', 'uploads');
        $banner_img_two = $this->imageUpdate($request,'banner_img_two', 'uploads');
        $data = [
            'banner_one' => [
                'url' => $request->url,
                'status' => $request->status == 'on' ? 1 : 0,
            ],
            'banner_two' => [
                'url' => $request->url_two,
                'status' => $request->status_two == 'on' ? 1 : 0,
            ]
        ];

        if(!empty($banner)){
            $data['banner_one']['banner'] = $banner;
        }else {
            $data['banner_one']['banner'] = $request->banner_empty;
        }

        if(!empty($banner_img_two)){
            $data['banner_two']['banner'] = $banner_img_two;
        }else {
            $data['banner_two']['banner'] = $request->banner_img_two;
        } 

        $value = json_encode($data);

            Advertisement::updateOrCreate(
                ['key' => 'advertisement_banner_two'],
                ['value' => $value]
            );
    
            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Banner one successfully'
            ]);

        
    }

    public function advertisementBannerThree(Request $request){
        $request->validate([
            'banner' => 'image',
            'banner_img_two' => 'image',
            'banner_img_three' => 'image',
            'url' => 'required',
            'url_two' => 'required',
            'url_three' => 'required',
            'status' => 'required',
            'status_two' => 'required',
            'status_three' => 'required',
        ]); 
        $banner = $this->imageUpdate($request,'banner', 'uploads');
        $banner_img_two = $this->imageUpdate($request,'banner_img_two', 'uploads');
        $banner_img_three = $this->imageUpdate($request,'banner_img_three', 'uploads');

        $data = [
            'banner_one' => [
                'url' => $request->url,
                'status' => $request->status == 'on' ? 1 : 0,
            ],
            'banner_two' => [
                'url' => $request->url_two,
                'status' => $request->status_two == 'on' ? 1 : 0,
            ],
            'banner_three' => [
                'url' => $request->url_three,
                'status' => $request->status_three == 'on' ? 1 : 0,
            ]
        ];

        if(!empty($banner)){
            $data['banner_one']['banner'] = $banner;
        }else {
            $data['banner_one']['banner'] = $request->banner_empty;
        }

        if(!empty($banner_img_two)){
            $data['banner_two']['banner'] = $banner_img_two;
        }else {
            $data['banner_two']['banner'] = $request->banner_two_empty;
        } 

        if(!empty($banner_img_three)){
            $data['banner_three']['banner'] = $banner_img_three;
        }else {
            $data['banner_three']['banner'] = $request->banner_three_empty;
        }

        $value = json_encode($data);

            Advertisement::updateOrCreate(
                ['key' => 'advertisement_banner_three'],
                ['value' => $value]
            );
    
            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Banner three successfully'
            ]);

        
    }

    public function advertisementBannerFour(Request $request){
        $request->validate([
            'banner' => 'image',
            'url' => 'required',
            'status' => 'required',
        ]); 
        $banner = $this->imageUpdate($request,'banner', 'uploads');
        $data = [
            'banner_four' => [
                'url' => $request->url,
                'status' => $request->status == 'on' ? 1 : 0,
            ]
        ];

        if(!empty($banner)){
            $data['banner_four']['banner'] = $banner;
        }else {
            $data['banner_four']['banner'] = $request->banner_empty;
        }

        $value = json_encode($data);

            Advertisement::updateOrCreate(
                ['key' => 'advertisement_banner_four'],
                ['value' => $value]
            );
    
            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Banner four successfully'
            ]);

        
    }

}
