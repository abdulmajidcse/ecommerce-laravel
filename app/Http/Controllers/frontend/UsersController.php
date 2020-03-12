<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Division;
use App\District;

class UsersController extends Controller
{

    //user dashboard function
    public function dashboard()
    {
    	return view('frontend.pages.users.user-dashboard');
    }

    //show profile information in the edit page
    public function edit()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $divisions = Division::orderBy('priority', 'asc')->get();
        return view('frontend.pages.users.edit-user', compact('user', 'divisions'));
    }

    /**
     * Show all district by division
     */
    public function selectDistrict($division_id)
    {
        if ($division_id != 'Select a division') {
            $districts = District::where('division_id', $division_id)->get();
            $count = count($districts);
            if ($count > 0) {
                echo "<select id='district_id' class='form-control' name='district_id'><option value='' selected>Select a district</option>";
                foreach ($districts as $value) {
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                }
                echo "</select>";
                echo "<script>document.getElementById('temporary_select').style.display='none';</script>";
            }  else {
                echo "<script type='text/javascript'>swal('No district!', 'Please, select another division.', 'warning');</script>";
            }
        } else {
            echo "";
        }
    }

    //update user profile
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:225|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|numeric|min:11|unique:users,phone,'.Auth::user()->id,
            'division_id' => 'required|numeric',
            'street_address' => 'required|string|max:225',
        ],
        [
            'division_id.required' => 'The division field is required.',
            'division_id.numeric' => 'Please, select a division.',
        ]);

        $user = Auth::user();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->street_address = $request->street_address;
        $user->save();

        $notification = [
            'message' => 'Successfully profile updated!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    //change password edit option
    public function changePassword()
    {
        return view('frontend.pages.users.change-password');
    }

    //change password store
    public function changePasswordStore(Request $request)
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

                $user = Auth::user();
                $user->password = Hash::make($newPassword);
                $user->save();
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
}
