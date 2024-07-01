<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\SmtpConfiguration;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $generalSetting = GeneralSetting::first();
        $smtpSetting = SmtpConfiguration::first();
        return view('admin.setting.index', compact(['generalSetting','smtpSetting']));
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
}
