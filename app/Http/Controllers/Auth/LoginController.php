<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistration;
use Illuminate\Http\Request;
use App\User;
use Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $block_user = User::where('status', 2)->where('email', $request->email)->first();
        // if user blocked by admin
        if ($block_user) {
            $request->session()->flash('message', 'Admin blocked you for some causes. If you active your account, please contact with admin.');
            $request->session()->flash('alert-type', 'warning');
            return redirect()->to('login');
        } else {
            $user = User::where('status', 1)->where('email', $request->email)->first();
            // if user active, get permission to login
            if (!is_null($user)) {
                if ($this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);
                }
            } else {
                $user_not_active = User::where('status', 0)->where('email', $request->email)->first();
                //if user not active by his email verification, sent a mail by user email address
                if (!is_null($user_not_active)) {
                    $user_not_active->remember_token = Str::random(50);
                    $user_not_active->save();
                    $user_not_active->notify(new VerifyRegistration($user_not_active));
                    $notification = [
                        'message' => 'A confirmation mail sent on your e-mail address. Please, check you e-mail and then try to login!',
                        'alert-type' => 'success',
                    ];
                    return redirect()->to('login')->with($notification);
                }
            }
        }
        

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
