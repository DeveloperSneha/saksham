<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Auth;

class ResetPasswordController extends CompanyController
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/company/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function showResetForm(Request $request, $token = null) {
        return view('company.password.reset')->with(
                        ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker() {
        return Password::broker('companies');
    }

    protected function guard() {
        return Auth::guard('company');
    }
}
