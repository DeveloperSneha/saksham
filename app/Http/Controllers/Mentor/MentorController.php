<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Http\Requests\MentorRequest;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class MentorController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:mentor');
    }

    public function index() {
        $mentors = \App\Mentor::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->first();
        $mentor_skills = $mentors->mentor_skill->pluck('idJobRole')->toArray();
        $candidates = DB::table('candidates')
                ->leftjoin('candidate_course_enrolments','candidate_course_enrolments.idCandidate','=','candidates.idCandidate')
                ->whereIn('candidate_course_enrolments.idJobRole',$mentor_skills)
                ->get();
        return view('mentor.dashboard', compact('mentors','candidates'));
    }
    
    public function profile() {
        $mentor = \App\Mentor::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->first();
        return view('mentor.profile', compact('mentor'));
    }

    public function EditProfile(){
        $sectors = \App\Sector::orderBy('sectorName')->get()->pluck('sectorName','idSector')->toArray(); 
        $mentor = \App\Mentor::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->first();
        return view('mentor.edit_profile', compact('mentor','sectors'));
    }

    public function updateProfile(MentorRequest $request){
        $mentor = \App\Mentor::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->first();
        $mentor->fill($request->all());
        if($request->has('photo')) {
            $file = $request->file('photo');
            $type = $request->file('photo')->getClientOriginalExtension();
            $imagedata = file_get_contents($file);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($imagedata);
            $mentor->photo = $base64;
        }
        $lang = $request->languages;
        $str_lang = implode (", ", $lang);
        $mentor->languages = $str_lang;
        DB::beginTransaction();
        $mentor->update();
        $mentor_skill = \App\MentorSkill::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->first();   
        $mentor_skill->fill($request->all());
        $mentor_skill->update();
        
      DB::commit();
      Auth::login($mentor);
        return redirect('mentor/profile');
    }
    
    public function getCandidates(){
        $m_jobrole = \App\MentorSkill::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->pluck('idJobRole')->toArray();
        
        $m_sector =\App\JobRole::whereIn('idJobRole',$m_jobrole)->pluck('idSector')->toArray();
        $sector =\App\JobRole::whereIn('idSector',$m_sector)->pluck('idJobRole')->toArray();
        $candidates =\App\CandidateCourseEnroll::whereIn('idJobRole',$sector)->get();
        return view('mentor.candidate',compact('candidates'));
    }
    
    public function startChat(){
        $m_jobrole = \App\MentorSkill::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->pluck('idJobRole')->toArray();
        
        $m_sector =\App\JobRole::whereIn('idJobRole',$m_jobrole)->pluck('idSector')->toArray();
        $sector =\App\JobRole::whereIn('idSector',$m_sector)->pluck('idJobRole')->toArray();
        $candidates =\App\CandidateCourseEnroll::whereIn('idJobRole',$sector)->get();
        return view('mentor.chats',compact('candidates'));
    }
    
    public function chatWithCandidate(Request $request , $id){          
        $m_jobrole = \App\MentorSkill::where('idMentor','=',Auth::guard('mentor')->user()->idMentor)->pluck('idJobRole')->toArray();
        
        $m_sector =\App\JobRole::whereIn('idJobRole',$m_jobrole)->pluck('idSector')->toArray();
        $sector =\App\JobRole::whereIn('idSector',$m_sector)->pluck('idJobRole')->toArray();
        $candidates =\App\CandidateCourseEnroll::whereIn('idJobRole',$sector)->get();
        $candidate =\App\Candidate::where('idCandidate','=',$id)->first();
        $prev_msg = \App\MentorCandidateChat::where('idSender','=',$id)->where('idReceiver','=',Auth::guard('mentor')->user()->idMentor)->OrWhere('idSender','=',Auth::guard('mentor')->user()->idMentor)->where('idReceiver','=',$id)->orderBy('idChat')->get();                
        return view('mentor.chatting',compact('candidates','prev_msg','candidate'));
    }

    public function saveChat(Request $request , $id){        
        $rules = [
            'message' => 'required',        ];
        $messages = [
          'message.required'=>'Please enter your message',
        ];
        $this->validate($request, $rules, $messages);            
        $senderId = Auth::guard('mentor')->user()->idMentor;
        $conversation = $id;             
        $chat = new \App\MentorCandidateChat(); 
        $chat->idSender =$senderId;
        $chat->senderType='mentor';
        $chat->idReceiver=$conversation;
        $chat->receiverType='candidate';
        $chat->message=$request->message;
        $chat->save();
        return redirect()->back();
    }

    public function editPassword() {
        return view('mentor.updt_password');
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
