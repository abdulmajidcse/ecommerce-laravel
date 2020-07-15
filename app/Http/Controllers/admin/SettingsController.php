<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::get()->first();
        return view('admin.settings.allSetting', ['settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Settings::get()->first();
        if (!empty($settings)) {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect('admin/settings')->with($notification);
        } else {
            return view('admin.settings.addSetting');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:225',
            'logo' => 'required|mimes:png|max:4000',
            'email' => 'required|email|max:225',
            'phone' => 'required|numeric|min:11',
            'address' => 'required|string',
            'shipping_cost' => 'required|numeric|min:10|max:500',
        ]);

        $settings = new Settings();
        $settings->name = $request->name;
        
        //if logo valid, go to upload logo and store settings
        $logo = $request->file('logo');
        if ($logo) {
            $extension = $request->logo->extension();
            $logo_name = time() . "." . $extension;
            $upload_path = 'images/settings-images/';
            $logo_url = $upload_path . $logo_name;

            $settings->logo = $logo_url;

            //logo upload on folder
            $logo->move($upload_path, $logo_name);
        }
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->address = $request->address;
        $settings->shipping_cost = $request->shipping_cost;
        $settings->save();

        $notification = [
            'message' => 'Successfully settings added!',
            'alert-type' => 'success',
        ];
        return redirect('admin/settings')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settings = Settings::find($id);
        if (empty($settings)) {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect('admin/settings')->with($notification);
        } else {
            return view('admin.settings.editSetting', ['settings' => $settings]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:225',
            'logo' => 'mimes:png|max:4000',
            'email' => 'required|email|max:225',
            'phone' => 'required|numeric|min:11',
            'address' => 'required|string',
            'shipping_cost' => 'required|numeric|min:10|max:500',
        ]);

        $settings = Settings::find($id);
        $settings->name = $request->name;
        
        //if logo valid, go to upload logo and store settings
        $logo = $request->file('logo');
        if ($logo) {
            $extension = $request->logo->extension();
            $logo_name = time() . "." . $extension;
            $upload_path = 'images/settings-images/';
            $logo_url = $upload_path . $logo_name;

            $settings->logo = $logo_url;

            //logo upload on folder
            $logo->move($upload_path, $logo_name);
        }
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->address = $request->address;
        $settings->shipping_cost = $request->shipping_cost;
        $settings->save();

        $notification = [
            'message' => 'Successfully settings saved!',
            'alert-type' => 'success',
        ];
        return redirect('admin/settings')->with($notification);
    }
}
