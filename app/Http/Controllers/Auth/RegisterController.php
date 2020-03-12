<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Notifications\VerifyRegistration;
use App\Division;
use App\District;
use Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     * from
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $divisions = Division::orderBy('priority', 'asc')->get();
        return view('auth.register', compact('divisions'));
    }

    /**
     * Show all district by division
     */
    public function select_district($division_id)
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:225|unique:users',
            'phone' => 'required|numeric|min:11|unique:users',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'street_address' => 'required|string|max:225',
            'password' => 'required|string|min:8|confirmed',
        ],
        [
            'division_id.required' => 'The division field is required.',
            'division_id.numeric' => 'Please, select a division.',
            'district_id.required' => 'The district field is required.',
            'district_id.numeric' => 'Please, select a district.',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'street_address' => $request->street_address,
            'ip_address' => request()->ip(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(50),
        ]);

        $user->notify(new VerifyRegistration($user));
        $notification = [
            'message' => 'A confirmation mail sent on your e-mail address. Please, check you e-mail and then try to login!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
