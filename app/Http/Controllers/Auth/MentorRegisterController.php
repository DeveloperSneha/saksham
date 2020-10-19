<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\MentorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Session;
use DB;

class MentorRegisterController extends Controller {
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
    protected $guard = 'mentor';
    protected $redirectTo = '/mentor';

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
        $sectors = \App\Sector::orderBy('sectorName')->get()->pluck('sectorName','idSector')->toArray();
        return view('mentor.register', compact('jobroles','sectors'));
    }

    public function register(MentorRequest $request) {
//        dd($request->all());
        $lang = $request->languages;
        $str_lang = implode (", ", $lang);
        $mentor = new \App\Mentor();
        $mentor->fill($request->all());
        $password = $request->password;
        $mentor->password = bcrypt($password);
        $mentor->languages = $str_lang;
        if($request->has('photo')) {
            $file = $request->file('photo');
            $type = $request->file('photo')->getClientOriginalExtension();
            $imagedata = file_get_contents($file);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($imagedata);
            // $base64 = 'data:image/jpeg;base64,' .base64_encode($imagedata);
            $mentor->photo = $base64;
        }
        DB::beginTransaction();
        $mentor->save();
        $mentor_skill = new \App\MentorSkill();            
        $mentor_skill->idMentor = $mentor->idMentor;
        $mentor_skill->fill($request->all());
        $mentor_skill->save();
        DB::commit();
        
        if (Auth::guard('mentor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
                    }
            return redirect('/mentor');
        }
    }

    protected function guard() {
        return Auth::guard('mentor');
    }

}
