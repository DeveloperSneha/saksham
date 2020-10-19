<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Session;
use DB;

class CompanyRegisterController extends Controller {
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
    protected $guard = 'company';
    protected $redirectTo = '/company';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get Registration Form
     *

     */
    public function showRegistrationForm() {
        return view('company.register');
    }

    public function register(Request $request) {
        $rules = [
            'companyName' => 'required|string|max:255',
            'ownerName'   => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:companies',
            'mobile'      => 'required|min:10|max:10',
            'password'    => 'required|min:6',
            'logo'        => 'mimes:jpg,png,jpeg|max:100',
            'companyProfile'=> 'required',
            'idState' => 'required',
            'idDistrict' => 'required',
            'location' => 'required',
            // 'website'     => 'required',
        ];
        $messages = [
          'companyName.required'=>'Company Name should not be empty',
          'ownerName.required'=>'Owner Name should not be empty',
          'email.required'=>'Company Email should not be empty',
          'mobile.required'=>'Company Contact No should not be empty',
          'ownerName.required' => 'Owner Name should not be empty.',
          'logo.mimes' => 'Logo must be file of type *png,*jpe,*jpeg',
          'logo.max' => 'Logo must not be greater than 100 KB',
          'companyProfile.required'=>'Company Profile should not be empty',
        //   'website.required' => 'Company Website should not be empty',
          'idState.required' => 'Select State First',
          'idDistrict.required' => 'Select District',
          'location.required' => 'Company location should not be empty',
          'password.required' => 'Password is required',
          'password.confirmed'=> 'Password & Confirm Password is not same',

        ];
        $this->validate($request, $rules, $messages);
        $company = new \App\Company();
        $company->fill($request->all());
        $password = $request->password;
        $company->password = bcrypt($password);
        if($request->has('logo')) {
            $file = $request->file('logo');
            $type = $request->file('logo')->getClientOriginalExtension();
            $imagedata = file_get_contents($file);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($imagedata);
            // $base64 = 'data:image/jpeg;base64,' .base64_encode($imagedata);
            $company->logo = $base64;
        }
        $company->save();
        $company_profile = new \App\CompanyProfile();
        $company_profile->fill($request->all());
        $company_profile->idCompany =$company->idCompany; 
        $company_profile->save();
        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
                    }
            return redirect('/company');
        }
        // $request->session()->with('message', ['Your Company has been registered Successfully']);
        // ->flash('message', 'Your Company has been registered Successfully');
        
        
        
        // return redirect('company')->with('message', ['Your Company has been registered Successfully']);
    }

    protected function guard() {
        return Auth::guard('company');
    }

}
