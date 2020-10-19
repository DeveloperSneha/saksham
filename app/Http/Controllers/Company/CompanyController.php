<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class CompanyController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:company');
    }

    public function index() {
        $company_profile = \App\CompanyProfile::where('idCompany','=',Auth('company')->user()->idCompany)->first();
        return view('company.dashboard', compact('company_profile'));
    }

    public function Profile(){
        $company_profile = \App\CompanyProfile::where('idCompany','=',Auth::guard('company')->user()->idCompany)->first();
        return view('company.profile', compact('company_profile'));
    }

    public function EditProfile(){
        $company_profile = \App\CompanyProfile::where('idCompany','=',Auth::guard('company')->user()->idCompany)->first();
        return view('company.edit_profile', compact('company_profile'));
    }

    public function updateProfile(Request $request){
        $company = \App\Company::where('idCompany', '=',Auth::guard('company')->user()->idCompany)->first();
        $rules = [
            'companyName' => 'required|string|max:255',
            'ownerName'   => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:companiesprofile,email,'.$company->idCompany. ',idCompany',
            'mobile'      => 'required|min:10|max:10|unique:companiesprofile,mobile,'.$company->idCompany. ',idCompany',
            'logo'        => 'mimes:jpg,png,jpeg|max:100',
            'companyProfile'=> 'required',
            'idState' => 'required',
            'idDistrict' => 'required',
            'location' => 'required',
            'website'     => 'required',
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
          'website.required' => 'Company Website should not be empty',
          'idState.required' => 'Select State First',
          'idDistrict.required' => 'Select District',
          'location.required' => 'Company location should not be empty',
        ];
        $this->validate($request, $rules, $messages);       
        $company->fill($request->all());
        if($request->has('logo')) {
            $file = $request->file('logo');
            $type = $request->file('logo')->getClientOriginalExtension();
            $imagedata = file_get_contents($file);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($imagedata);
            $company->logo = $base64;
        }
        DB::beginTransaction();
        $company->update();
        $company_profile = \App\CompanyProfile::where('idCompany', '=',Auth::guard('company')->user()->idCompany)->first();
        $company_profile->fill($request->all());
        $company_profile->update();
        DB::commit();
        Auth::login($company);
        return redirect('company/profile');
    }

    public function editPassword() {
        return view('company.updt_password');
    }

    public function updatePassword(Request $request) {
        $rules = [];
        $user = $request->user();
        if (!auth()->attempt(['email' => $user->email, 'password' => $request->old_password])) {
            session()->flash('error','Wrong old password. Authentication failed');
            // flash()->error('Wrong old password. Authentication failed');
            return redirect()->back();
        }
        $this->validate($request, $rules + [
            'password' => 'required|min:6|confirmed',
        ]);
        $user->password = bcrypt($request['password']);
        $user->update();
        Auth::login($user);
        session()->flash('message','Password updated successfully.');
        // flash()->success('Password updated successfully.');
        return redirect()->back();
    }

}
