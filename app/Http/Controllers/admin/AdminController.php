<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Auth;
use Hash;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function profile()
    {
        return view('admin.profile.profileDetails');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.profile.editProfile', ['admin' => $admin]);
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:200|unique:admins,email,'.$id,
            'phone' => 'nullable|min:11|numeric|unique:admins,phone_no,'.$id,
            'image' => 'mimes:jpg,jpeg,png|max:4000',
        ]);

       $admin = Admin::find($id);

       $data = array();

       $data['name'] = $request->name;
       $data['email'] = $request->email;
       $data['phone'] = $request->phone;
       $image = $request->file('image');

       /**
        * if image valid, go to upload image and store admin
        */
       if ($image) {
            //old image
            $old_image = $admin->image;
            if (!is_null($old_image)) {
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/admin-images/';
            $image_url = $upload_path . $image_name;

            //admin table store
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->image = $image_url;
            $admin->phone_no = $data['phone'];
            $admin->save();

            //image upload on folder
            $image->move($upload_path, $image_name);

            //confirm message
            $notification = [
                'message' => 'Successfully profile saved!',
                'alert-type' => 'success',
            ];
        } else {
            //admin table store
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->phone_no = $data['phone'];
            $admin->save();
            //confirm message
            $notification = [
                'message' => 'Successfully profile saved!',
                'alert-type' => 'success',
            ];
        }

       return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        return view('admin.profile.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ]);

        $userPassword = Auth::user()->password;
        $oldPassword = $request->old_password;
        $newPassword = $request->new_password;
        $confirmPassword = $request->confirm_password;
        if (Hash::check($oldPassword, $userPassword)) {
            if ($newPassword == $confirmPassword) {

                $admin = Auth::user();
                $admin->password = Hash::make($newPassword);
                $admin->save();
                $notification = [
                    'message' => 'Successfully password changed!',
                    'alert-type' => 'success'
                ];
                return redirect()->back()->with($notification);

            } else {
                $notification = [
                    'message' => 'New password does not match to confirm password!',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = [
                'message' => 'Old password does not match!',
                'alert-type' => 'warning'
            ];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
