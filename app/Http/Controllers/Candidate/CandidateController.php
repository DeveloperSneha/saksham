<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRequest;
use Auth;
use DB;

class CandidateController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:candidate');
    }

    public function index() {
        $candidate = \App\Candidate::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->first();
        $scheme = \App\Scheme:: orderBy('idScheme')->get();
        return view('candidate.dashboard', compact('candidate','scheme'));
    }

    public function profile() {
        $candidate = \App\Candidate::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->first();
        return view('candidate.profile', compact('candidate'));
    }

    public function EditProfile(){
        $candidate = \App\Candidate::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->first();
        return view('candidate.edit_profile', compact('candidate'));
    }

    public function updateProfile(CandidateRequest $request){
        $candidate = \App\Candidate::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->first();
        $candidate->fill($request->all());
        if($request->has('image')) {
            $file = $request->file('image');
            $type = $request->file('image')->getClientOriginalExtension();
            $imagedata = file_get_contents($file);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($imagedata);
            $candidate->image = $base64;
        }
        DB::beginTransaction();
        $candidate->update();

        $candidate_enrolled = \App\CandidateCourseEnroll::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->first();
        $candidate_enrolled->idJobRole = $request->idJobRole;
        $candidate_enrolled->update();
        if($request->has('qualifications')){
      foreach ($request->qualifications as $key => $value) {
        $candidate_academic = new \App\CandidateAcademic();            
        $candidate_academic->idCandidate = Auth::user()->idCandidate;
        $candidate_academic->idDistrict = $value['idDistrict'];
        $candidate_academic->idUniversity = $value['idUniversity'];
        $candidate_academic->idQualification = $value['idQualification'];
        $candidate_academic->passedYear = $value['passedYear'];
        $candidate_academic->percentage = $value['percentage'];
        $candidate_academic->idMedium = $value['idMedium'];
        $candidate_academic->save();
      }
    }
        if($request->has('questions')){
          foreach ($request->questions as $key1 => $value1) {
            $sector_answer = new \App\SectorAnswer();
            $sector_answer->idCandidate = Auth::user()->idCandidate;
            $sector_answer->q4 =$value1;
            $sector_answer->save();
          } 
        }
    
      $candidate_answer = new \App\CandidateAnswer();
      $candidate_answer->idCandidate =Auth::user()->idCandidate;
      $candidate_answer->q1 = $request->questions_1;
      $candidate_answer->q2 = $request->questions_2;
      $candidate_answer->q3 = $request->questions_3;
      $candidate_answer->q5 = $request->questions_5;
      $candidate_answer->q6 = $request->questions_6;
      $candidate_answer->q7 = $request->questions_7;
      $candidate_answer->q8 = $request->questions_8;
      $candidate_answer->q9 = $request->questions_9;
      $candidate_answer->q10 = $request->questions_10;
      $candidate_answer->q11 = $request->questions_11;
      $candidate_answer->q12 = $request->questions_12;
      $candidate_answer->q13 = $request->questions_13;
      $candidate_answer->save();
      DB::commit();
      Auth::login($candidate);
        return redirect('candidate/profile');
    }

    public function getJobs(){
        $jobs =\App\JobSession::where('isActive','=','Yes')->whereDate('toDate', '>=', \Carbon\Carbon::today()->toDateString())->get();
        return view('candidate.available_jobs', compact('jobs'));
    }
    
    public function getSchemeJobs($id){
        $company_jobs = DB::table('jobsession')
                        ->join('jobs','jobsession.idJob','=','jobs.idJob')
                        ->join('job_location','jobs.idJob','=','job_location.idJob')
                        ->join('companies','jobs.idCompany','=','companies.idCompany')
                        ->join('jobrole','jobs.idJobRole','=','jobrole.idJobRole')
                        ->join('sector','jobrole.idSector','=','sector.idSector')
                        ->join('experience','jobs.idExperience','=','experience.idExperience')
                        ->join('qualifications','jobs.idQualification','qualifications.idQualification')
                        ->join('districts','job_location.idDistrict','=','districts.idDistrict')
                        ->where('sector.idScheme','=',$id)
                        ->where('isActive','=','Yes')
                        ->whereDate('toDate', '>=', \Carbon\Carbon::today()->toDateString())
                        ->select(DB::raw('group_concat(districtName) AS districtName'), 'startDate','toDate','companyName','logo','jobRoleName','sectorName','experienceName','qName','vacancies','jobDescription','designation','shortName','jobs.idJob')
                        ->groupBy('jobs.idJob')
                        ->orderBy('idJob','DESC')
                        ->get();
                        
        return view('candidate.scheme_jobs', compact('company_jobs'));
    }
    
    public function viewJobDetails($id){
        $job_details =\App\JobSession::where('idJob','=',$id)->first();
        return view('candidate.job_details', compact('job_details'));
    }
    
    public function SaveAppliedJob(Request $request ,$id){
        $candidate = \App\Candidate::where('idCandidate', '=', Auth::guard('candidate')->user()->idCandidate)->first();
        
        $applied = new \App\JobApplied();
        $applied->fill($request->all());
        $applied->idCandidate = Auth::user()->idCandidate;
        $applied->idJob = $id;
        $applied->save();
        return redirect('/candidate/applied')->with('message', 'You have successfully applied for this Job!');
        return view('candidate.job_details', compact('job_details'));
    }

    public function viewAppliedJobs(){
        $applied_jobs =\App\JobApplied::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->get();
        return view('candidate.applied_jobs', compact('applied_jobs'));
    }

    public function viewMentors(){
        $candidate_sector =\App\CandidateCourseEnroll::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->pluck('idJobRole')->toArray();
        $sector = \App\JobRole::whereIn('idJobRole',$candidate_sector)->pluck('idSector')->toArray();
        $jobroles = \App\JobRole::whereIn('idSector',$sector)->pluck('idJobRole')->toArray();
        $mentors =\App\MentorSkill::whereIn('idJobRole',$jobroles)->get();
        return view('candidate.mentors', compact('mentors'));
    }
    
    public function viewMentorsDetails($id){
        $mentor =\App\Mentor::where('idMentor','=',$id)->first();
        return view('candidate.mentors_details', compact('mentor'));
    }

    public function showChat(){
        $c_jobrole = \App\CandidateCourseEnroll::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->pluck('idJobRole')->toArray();
        
        $c_sector =\App\JobRole::whereIn('idJobRole',$c_jobrole)->pluck('idSector')->toArray();
        $sector =\App\JobRole::whereIn('idSector',$c_sector)->pluck('idJobRole')->toArray();
        $mentors =\App\MentorSkill::whereIn('idJobRole',$sector)->get();
        return view('candidate.chats',compact ('mentors'));
    }

    public function chatWithMentor($id){              
        $c_jobrole = \App\CandidateCourseEnroll::where('idCandidate','=',Auth::guard('candidate')->user()->idCandidate)->pluck('idJobRole')->toArray();
        
        $c_sector =\App\JobRole::whereIn('idJobRole',$c_jobrole)->pluck('idSector')->toArray();
        $sector =\App\JobRole::whereIn('idSector',$c_sector)->pluck('idJobRole')->toArray();
        $mentors =\App\MentorSkill::whereIn('idJobRole',$sector)->get();
        $mentor =\App\Mentor::where('idMentor','=',$id)->first();
        $prev_msg = \App\MentorCandidateChat::where('idSender','=',Auth::guard('candidate')->user()->idCandidate)->where('idReceiver','=',$id)->OrWhere('idSender','=',$id)->where('idReceiver','=',Auth::guard('candidate')->user()->idCandidate)->orderBy('idChat')->get();                
        return view('candidate.chatting',compact('mentors','prev_msg','mentor'));
    }

    public function storeChat(Request $request , $id){      
        $rules = [
            'message' => 'required',        ];
        $messages = [
          'message.required'=>'Please enter your message',
        ];
        $this->validate($request, $rules, $messages);            
        $senderId = Auth::guard('candidate')->user()->idCandidate;
        $conversation = $id;             
        $chat = new \App\MentorCandidateChat(); 
        $chat->idSender =$senderId;
        $chat->senderType='candidate';
        $chat->idReceiver=$conversation;
        $chat->receiverType='mentor';
        $chat->message=$request->message;
        $chat->save();
        return redirect()->back();
    }

    public function editPassword() {
        return view('candidate.updt_password');
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
