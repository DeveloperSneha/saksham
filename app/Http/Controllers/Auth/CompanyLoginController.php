<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;

class CompanyLoginController extends Controller
{
     protected $redirectTo = '/company';

    public function __construct() {
        $this->middleware('guest:company')->except('logout');
    }

    public function showLoginForm() {
        return view('company.login');
    }

    public function login(Request $request) {
    	$rules = [
            'email' => 'required|exists:companies',
            'password' => 'required'
        ];
        $messages = [
            'email.required' => 'Enter Your Email.',
            'password.required' => 'Enter Your Password.'
        ];
        $this->validate($request, $rules, $messages);
         // Attempt to log the company in
        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            
            return redirect('/company');
        }
        return Redirect::back()->withInput($request->only('email'))->withErrors(['msg' => 'Your Credential Doesnot Match.Please Try Again !!']);
        
    }

    public function logout(Request $request) {
        Auth::guard('company')->logout();

        //$request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        //  return redirect('/company/login');
        return redirect()->guest(route('company.login'));
    }

    protected function guard() {
        return Auth::guard('company');
    }
}
