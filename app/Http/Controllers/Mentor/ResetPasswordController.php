<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Auth;

class ResetPasswordController extends MentorController
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/mentor/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:mentor');
    }
    
    public function showResetForm(Request $request, $token = null) {
        return view('mentor.password.reset')->with(
                        ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker() {
        return Password::broker('mentors');
    }

    protected function guard() {
        return Auth::guard('mentor');
    }
}
