<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;


class ForgotPasswordController extends CompanyController
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    public function showLinkRequestForm() {
        return view('company.password.email');
    }

    public function broker() {
        return Password::broker('companies');
    }

    protected function guard() {
        return Auth::guard('company');
    }

    public function sendResetLinkEmail(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|exists:companies',
//            'g-recaptcha-response' => 'required|captcha'
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
                $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT ? $this->sendResetLinkResponse($response) : $this->sendResetLinkFailedResponse($request, $response);
    }
}
