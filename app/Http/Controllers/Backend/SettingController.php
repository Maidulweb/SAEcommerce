<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Logo;
use App\Models\PusherSetting;
use App\Models\SmtpConfiguration;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;
    public function index(){
        $generalSetting = GeneralSetting::first();
        $smtpSetting = SmtpConfiguration::first();
        $logoSetting = Logo::first();
        $pusherSetting = PusherSetting::first();
        return view('admin.setting.index', compact(['generalSetting','smtpSetting','logoSetting','pusherSetting']));
    }

    public function generalSettingUpdate(Request $request){
        $request->validate([
            'site_name'=> ['required'],
            'layout'=> ['required'],
            'contact_email'=> ['required'],
            'currency_name'=> ['required'],
            'currency_icon'=> ['required'],
            'timezone'=> ['required'],
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->contact_email,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'timezone' => $request->timezone,
            ]
        );

        return redirect()->back()->with([
            'message' => 'Updated',
            'alert-type' => 'success'
        ]);
    }

    public function smtpSettingUpdate(Request $request){
        $request->validate([
            'email'=> ['required'],
            'host'=> ['required'],
            'username'=> ['required'],
            'password'=> ['required'],
            'port'=> ['required'],
            'encryption'=> ['required'],
        ]);

        SmtpConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'email' => $request->email,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'encryption' => $request->encryption,
            ]
        );

        return redirect()->back()->with([
            'message' => 'Updated',
            'alert-type' => 'success'
        ]);
    }

    public function logoUpdate(Request $request){
      

        $logo = $this->imageUpdate($request,'logo','uploads');
        $favicon = $this->imageUpdate($request,'favicon','uploads');
        $footer_logo = $this->imageUpdate($request,'footer_logo','uploads');

        Logo::updateOrCreate(
            ['id' => 1],
            [
             'logo' => !empty($logo) ? $logo : $request->old_logo,
             'favicon' => !empty($favicon) ? $favicon : $request->old_favicon,
             'footer_logo' => !empty($footer_logo) ? $footer_logo : $request->old_footer_logo,
            ]
        );

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Logo setting updated'
        ]);
    }

  function pusherSettingUpdate(Request $request): RedirectResponse{
      $validated = $request->validate([
            'app_id'=> ['required'],
            'key'=> ['required'],
            'secret'=> ['required'],
            'cluster'=> ['required']
        ]);
        PusherSetting::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()->back()->with([
            'message' => 'Pusher Setting Updated',
            'alert-type' => 'success'
        ]);
    }
}
