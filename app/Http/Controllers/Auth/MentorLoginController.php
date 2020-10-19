<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;

class MentorLoginController extends Controller
{
    

    protected $redirectTo = '/mentor';

    public function __construct() {
        $this->middleware('guest:mentor')->except('logout');
    }

    public function showLoginForm() {
        return view('mentor.login');
    }

    public function login(Request $request) {
    	$rules = [
            'email' => 'required|exists:mentors',
            'password' => 'required'
        ];
        $messages = [
            'email.required' => 'Enter Your Email.',
            'password.required' => 'Enter Your Password.'
        ];
        $this->validate($request, $rules, $messages);
         // Attempt to log the mentor in
        if (Auth::guard('mentor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            
            return redirect('/mentor');
        }
        return Redirect::back()->withInput($request->only('email'))->withErrors(['msg' => 'Your Credential Doesnot Match.Please Try Again !!']);
        
    }

    public function logout(Request $request) {
        Auth::guard('mentor')->logout();

        //$request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        //  return redirect('/mentor/login');
        return redirect()->guest(route('mentor.login'));
    }

    protected function guard() {
        return Auth::guard('mentor');
    }
}
