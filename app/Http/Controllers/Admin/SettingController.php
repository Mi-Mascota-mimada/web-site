<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $uploadPath = 'uploads/logo/';
        $setting = Setting::first();
        $logo = '';
        $main_logo = '';
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $name = $setting ? $setting->website_name . '.'  : $request->website_name;
            $filename = 'logo-'. $name . $ext ;
            $filename = str_replace(" ", "_", $filename);
            $file->move($uploadPath, $filename);
            $logo = $uploadPath . $filename;
        }
        if($request->hasFile('main_logo')){
            $file = $request->file('main_logo');
            $ext = $file->getClientOriginalExtension();
            $name = $setting ? $setting->website_name . '.'  : $request->website_name;
            $filename = 'main_logo-'. $name . $ext ;
            $filename = str_replace(" ", "_", $filename);
            $file->move($uploadPath, $filename);
            $main_logo = $uploadPath . $filename;
        }
        
        if($setting){
            //Update Data
            $setting->update([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'page_title' => $request->page_title,
                'logo' => $logo,
                'main_logo' => $main_logo,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'email1' => $request->email1,
                'email2' => $request->email2,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube
            ]);
            return redirect()->back()->with('message', 'Settings Updated');
        }else{
            //Create Data
            Setting::create([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'page_title' => $request->page_title,
                'logo' => $logo,
                'main_logo' => $main_logo,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'email1' => $request->email1,
                'email2' => $request->email2,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube
            ]);

            return redirect()->back()->with('message', 'Settings Created');
        }
    }
}
