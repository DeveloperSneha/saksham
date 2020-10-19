<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\CandidateRequest;
use Auth;
use Session;
use DB;

class CandidateRegisterController extends Controller {
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
    protected $guard = 'candidate';
    protected $redirectTo = '/candidate';

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
      return view('candidate.register');
    }

    public function register(Request $request) {
      $rules = [
            'firstName'=>'required',
            'aadhar'=>'required|unique:candidates',
            'email' => 'required|string|email|max:255|unique:candidates',
            'mobile' => 'required|min:10|max:10|unique:candidates',
            'idGender' =>'required',
            'maritalStatus'=>'required',
            'idDisabled'=>'required',
            'motherName' =>'required',
            'fatherName' =>'required',
            'dob'=>'required|date|before:today',
            'idSector'=>'required',          
            'idJobRole'=>'required',          
            'password' => 'required|string|min:6|confirmed',
            'image' =>'mimes:jpg,png,jpeg|max:100',
      ];
      $messages = [
            'firstName.required' => 'Enter Your First Name.',
            'aadhar.required' => 'Enter Your Aadhaar Number.',
            'email.required' => 'Enter Your Email Id.',
            'dob.required' => 'Select Your date of Birth.',
            'fatherName.required' => 'Enter Your Father Name.',
            'motherName.required' => 'Enter Your Mother Name.',
            'mobile.required' => 'Enter Your Contact Number.',
            'idGender.required' => 'Select Your Gender',
            'maritalStatus.required' => 'Select Your Marital Status.',
            'idSector.required' => 'Select Sector',
            'idJobRole.required' => 'Select Job Role',
            'image.max' => 'Image must not be greater than 100 KB',
      ];
      $this->validate($request, $rules, $messages);
      $candidate = new \App\Candidate();
      $candidate->fill($request->all());
      $password = $request->password;
      $candidate->pass = $password;
      $candidate->password = bcrypt($password);
      if($request->has('image')) {
        $file = $request->file('image');
        $type = $request->file('image')->getClientOriginalExtension();
        $imagedata = file_get_contents($file);
        $base64 = 'data:image/'.$type.';base64,'.base64_encode($imagedata);
        $candidate->image = $base64;
      }
      DB::beginTransaction();
      $candidate->save();

      $candidate_enrolled = new \App\CandidateCourseEnroll();
      $candidate_enrolled->idCandidate =$candidate->idCandidate;
      $candidate_enrolled->idJobRole = $request->idJobRole;
      $candidate_enrolled->save();

      // foreach ($request->qualifications as $key => $value) {
      //   $candidate_academic = new \App\CandidateAcademic();            
      //   $candidate_academic->idCandidate = $candidate->idCandidate;
      //   $candidate_academic->idDistrict = $value['idDistrict'];
      //   $candidate_academic->idUniversity = $value['idUniversity'];
      //   $candidate_academic->idQualification = $value['idQualification'];
      //   $candidate_academic->passedYear = $value['passedYear'];
      //   $candidate_academic->percentage = $value['percentage'];
      //   $candidate_academic->idMedium = $value['idMedium'];
      //   $candidate_academic->save();
      // }

      // foreach ($request->question as $key1 => $value1) {
      //   $sector_answer = new \App\SectorAnswer();
      //   $sector_answer->idCandidate = $candidate->idCandidate;
      //   $sector_answer->q4 =$value1;
      //   $sector_answer->save();
      // }        
    
      // $candidate_answer = new \App\CandidateAnswer();
      // $candidate_answer->idCandidate = $candidate->idCandidate;
      // $candidate_answer->q1 = $request->questions_1;
      // $candidate_answer->q2 = $request->questions_2;
      // $candidate_answer->q3 = $request->questions_3;
      // $candidate_answer->q5 = $request->questions_5;
      // $candidate_answer->q6 = $request->questions_6;
      // $candidate_answer->q7 = $request->questions_7;
      // $candidate_answer->q8 = $request->questions_8;
      // $candidate_answer->q9 = $request->questions_9;
      // $candidate_answer->q10 = $request->questions_10;
      // $candidate_answer->q11 = $request->questions_11;
      // $candidate_answer->q12 = $request->questions_12;
      // $candidate_answer->q13 = $request->questions_13;
      // $candidate_answer->save();

      DB::commit();
      
      if (Auth::guard('candidate')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
                    }
            return redirect('/candidate');
        }
    }

    public function showEnrolForm($id){
        return view('candidate.enrol');
    }

    public function saveEnrolData(Request $request){
        dd('here');
    }

    protected function guard() {
        return Auth::guard('candidate');
    }

}
