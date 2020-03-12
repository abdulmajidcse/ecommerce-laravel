<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RegisterVerifyController extends Controller
{
	//check user active and verify user token
    public function verifyToken($token){
    	$user = User::where('remember_token', $token)->first();
    	if (!is_null($user)) {
    		$user->status = 1;
    		$user->remember_token = NULL;
    		$user->save();
    		session()->flash('message', 'You are registered successfully! Now, log in.');
    		session()->flash('alert-type', 'success');
    		return redirect('login');
    	} else {
    		session()->flash('message', 'Your token is not matched!');
    		session()->flash('alert-type', 'error');
    		return redirect('/');
    	}
    }
}
