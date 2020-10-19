<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;

class CandidateLoginController extends Controller {

    protected $redirectTo = '/candidate';

    public function __construct() {
        $this->middleware('guest:candidate')->except('logout');
    }

    public function showLoginForm() {
        return view('candidate.login');
    }

    public function login(Request $request) {
    	$rules = [
            'mobile' => 'required|exists:candidates',
            'password' => 'required'
        ];
        $messages = [
            'mobile.required' => 'Enter Your Mobile Number.',
            'password.required' => 'Enter Your Password.'
        ];
        $this->validate($request, $rules, $messages);
         // Attempt to log the candidate in
        if (Auth::guard('candidate')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location 
            flash()->success('Welcome ,Please Complete your Profile.');           
            return redirect('/candidate/editprofile');
        }
        return Redirect::back()->withInput($request->only('mobile'))->withErrors(['msg' => 'Your Credential Doesnot Match.Please Try Again !!']);
        
    }

    public function logout(Request $request) {
        Auth::guard('candidate')->logout();

        //$request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        //  return redirect('/candidate/login');
        return redirect()->guest(route('candidate.login'));
    }

    protected function guard() {
        return Auth::guard('candidate');
    }

}
