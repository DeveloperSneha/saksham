<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Auth;

class ResetPasswordController extends CandidateController
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/candidate/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:candidate');
    }
    
    public function showResetForm(Request $request, $token = null) {
        return view('candidate.password.reset')->with(
                        ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker() {
        return Password::broker('candidates');
    }

    protected function guard() {
        return Auth::guard('candidate');
    }
}
