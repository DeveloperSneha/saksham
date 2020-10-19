<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $COURSES = \App\Scheme::all();
        $DARPAN_SECTOR_WISE = \App\DarpanSectorWise::all();
        $DARPAN_DISTRICT_WISE = \App\DarpanDistrictWise::all();
        $DARPAN_JOB_ROLE_WISE = \App\DarpanJobRoleWise::all();
        $DARPAN_CANDIDATE_STATUS = array(
                'training' => array(
                    'name' => 'Enrolled',
                    'icon' => 'fa-users-cog'
                ),
                'trained' => array(
                    'name' => 'Trained',
                    'icon' => 'fa-user-check'
                ),
                'assessed' => array(
                    'name' => 'Assessed',
                    'icon' => 'fa-file-signature'
                ),
                'certified' => array(
                    'name' => 'Certified',
                    'icon' => 'fa-graduation-cap'
                ),
                // 'placed' => array(
                //     'name' => 'Placed',
                //     'icon' => 'fa-user-graduate'
                // )
        );
        $DARPAN_CANDIDATE_GENDER = array(
            'female' => 'Female',
            'male' => 'Male',
        );
        return view('admin.home',compact('DARPAN_SECTOR_WISE','COURSES','DARPAN_CANDIDATE_STATUS','DARPAN_CANDIDATE_GENDER','DARPAN_DISTRICT_WISE','DARPAN_JOB_ROLE_WISE'));
    }

    /**
     * Display a listing of the Companies.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function dashboard()
    {
        $COURSES = \App\Scheme::all();
        $DARPAN_SECTOR_WISE = \App\DarpanSectorWise::all();
        $DARPAN_DISTRICT_WISE = \App\DarpanDistrictWise::all();
        $DARPAN_JOB_ROLE_WISE = \App\DarpanJobRoleWise::all();
        $DARPAN_CANDIDATE_STATUS = array(
                'training' => array(
                    'name' => 'Enrolled',
                    'icon' => 'fa-users-cog'
                ),
                'trained' => array(
                    'name' => 'Trained',
                    'icon' => 'fa-user-check'
                ),
                'assessed' => array(
                    'name' => 'Assessed',
                    'icon' => 'fa-file-signature'
                ),
                'certified' => array(
                    'name' => 'Certified',
                    'icon' => 'fa-graduation-cap'
                ),
                // 'placed' => array(
                //     'name' => 'Placed',
                //     'icon' => 'fa-user-graduate'
                // )
        );
        $DARPAN_CANDIDATE_GENDER = array(
            'female' => 'Female',
            'male' => 'Male',
        );
        return view('admin.dashboard',compact('DARPAN_SECTOR_WISE','COURSES','DARPAN_CANDIDATE_STATUS','DARPAN_CANDIDATE_GENDER','DARPAN_DISTRICT_WISE','DARPAN_JOB_ROLE_WISE'));
    }
    
    public function companies()
    {
        // $companies = \App\Company::get();
        $companies =DB::table('companies')
                    ->leftjoin('companiesprofile','companies.idCompany','=','companiesprofile.idCompany')
                    ->leftjoin('districts','companiesprofile.idDistrict','districts.idDistrict')
                    ->where('status','=',1)
                    ->select('companies.idCompany','districtName','companyName','companies.email','mobile','companies.created_at','ownerName','logo')
                    ->get();
        return view('admin.companies',compact('companies'));
    }
    
    /**
     * Display a listing of the Candidates.
     *
     * @return \Illuminate\Http\Response
     */

    public function candidates()
    {   
        $candidates = \App\Candidate::get();
        return view('admin.candidates',compact('candidates'));
    }
    
    public function applied()
    {
        // $applied_jobs = \App\JobApplied::all();
        $applied_jobs =DB::table('jobapplied')
                        ->join('jobs','jobapplied.idJob','=','jobs.idJob')
                        ->join('candidates','jobapplied.idCandidate','=','candidates.idCandidate')
                        ->join('jobrole','jobs.idJobRole','=','jobrole.idJobRole')
                        ->join('sector','jobrole.idSector','=','sector.idSector')
                        ->join('companies','jobs.idCompany','=','companies.idCompany')
                        ->select('companyName','firstName','lastName','candidates.mobile','shortName','jobRoleName','jobapplied.updated_at','idJobApplied')
                        ->get();
        return view('admin.applied',compact('applied_jobs'));
    }


    /**
     * Display a listing of the Mentors.
     *
     * @return \Illuminate\Http\Response
     */
    public function mentors()
    {
        // $mentors = \App\Mentor::get();
        $mentors =DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','=','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','=','sector.idSector')
                    ->join('experience','mentors_skills.idExperience','=','experience.idExperience')
                    ->where('status','=',1)
		    ->select('firstName','lastName','experienceName','jobRoleName','email','mobile','mentors.created_at','photo','mentors.idMentor')
                    ->get();
        return view('admin.mentors',compact('mentors'));
    }

    public function candidateDetails($id){
        $candidate = \App\Candidate::where('idCandidate','=',$id)->first();
        return view('admin.candidate_details',compact('candidate'));
    }

    public function addNotification(){
        return view('admin.add_notification');
    }
    
    public function importData() {
        return view('admin.import');
    }
    
    public function exportData() {
         return view('admin.export');
    }
    
    public function jobActivated() {
        // $active_jobs =\App\JobSession::where('isActive','=','Yes')
        //             ->whereDate('toDate', '>=', \Carbon\Carbon::today()->toDateString())->get();
        $active_jobs =DB::table('jobsession')
                        ->join('jobs','jobsession.idJob','=','jobs.idJob')
                        ->join('job_location','jobs.idJob','=','job_location.idJob')
                        ->join('companies','jobs.idCompany','=','companies.idCompany')
                        ->join('jobrole','jobs.idJobRole','=','jobrole.idJobRole')
                        ->join('sector','jobrole.idSector','=','sector.idSector')
                        ->join('experience','jobs.idExperience','=','experience.idExperience')
                        ->join('districts','job_location.idDistrict','=','districts.idDistrict')
                        ->where('isActive','=','Yes')
                        ->whereDate('toDate', '>=', \Carbon\Carbon::today()->toDateString())
                        ->select(DB::raw('group_concat(districtName) AS districtName'), 'startDate','toDate','companyName','logo','jobRoleName','sectorName','experienceName','idJobSession')
                        ->groupBy('jobs.idJob')
                        ->get();
         return view('admin.activated_jobs', compact('active_jobs'));
    }
    
    public function jobDeactivated() {
        // $deactive_jobs = \App\JobSession::where('isActive','=','No')
        //               ->orWhereDate('toDate', '<', \Carbon\Carbon::today()->toDateString())->get();
        $deactive_jobs =DB::table('jobsession')
                        ->join('jobs','jobsession.idJob','=','jobs.idJob')
                        ->join('job_location','jobs.idJob','=','job_location.idJob')
                        ->join('companies','jobs.idCompany','=','companies.idCompany')
                        ->join('jobrole','jobs.idJobRole','=','jobrole.idJobRole')
                        ->join('sector','jobrole.idSector','=','sector.idSector')
                        ->join('experience','jobs.idExperience','=','experience.idExperience')
                        ->join('districts','job_location.idDistrict','=','districts.idDistrict')
                        ->where('isActive','=','No')
                        ->orWhereDate('toDate', '<', \Carbon\Carbon::today()->toDateString())
                        ->select(DB::raw('group_concat(districtName) AS districtName'), 'startDate','toDate','companyName','logo','jobRoleName','sectorName','experienceName','idJobSession')
                        ->groupBy('jobs.idJob')
                        ->get();
         return view('admin.deactivated_jobs', compact('deactive_jobs'));
    }

    public function destroyCandidate($id)
    {
        $candidate = \App\Candidate::where('idCandidate', '=', $id)->first();
        $course_enroll=\App\CandidateCourseEnroll::where('idCandidate', '=', $id)->first();
        $candidate_answer =\App\CandidateAnswer::where('idCandidate', '=', $id)->first();
        $candidate_sector =\App\SectorAnswer::where('idCandidate', '=', $id)->get();
        $candidate_academic =\App\CandidateAcademic::where('idCandidate', '=', $id)->get();
        $candidate_applied = \App\JobApplied::where('idCandidate', '=', $id)->get();
        if($candidate_applied->count() > 0){
            return redirect()->back()->with('message', 'You Can not Delete this Candidate Because Candidate Already Applied For Job!');
        }
        else{      
            if($candidate_sector->count() > 0){foreach($candidate_sector as $sector){$sector->delete();}} 
            else if(!empty($candidate_answer)){$candidate_answer->delete();}
            
            else if($candidate_academic->count() > 0){foreach($candidate_academic as $academic){$academic->delete();}} 
            else if(!empty($course_enroll)){$course_enroll->delete();}
            $candidate->delete();
            flash('Candidate Deleted Successfully');
        }
        return redirect('admin/candidates');
    }

    public function destroyCompany($id)
    {
        $company = \App\Company::where('idCompany', '=', $id)->first();
        $jobs = \App\Job::where('idCompany', '=', $id)->first();
        $job = \App\Job::where('idCompany', '=', $id)->pluck('idJob')->toArray();
        $job_session =\App\JobSession::whereIn('idJob', $job)->get();
        $job_loc =\App\JobLocation::whereIn('idJob', $job)->get();
        $candidate_applied = \App\JobApplied::whereIn('idJob', $job)->get();
        if($candidate_applied->count() > 0){
            return redirect()->back()->with('message', 'You can not delete this Company Because Candidate already applied for Jobs posted by this company!');
        }
        else{
            if($job_session->count() > 0){foreach($job_session as $var){$var->delete();}} 
            else if($job_loc->count() > 0){foreach($job_loc as $loc){$loc->delete();}} 
            else if(!empty($jobs)){$jobs->delete();}
            $company->delete();
            flash('Company Deleted Successfully');
        }
        return redirect('admin/companies');
    }

    public function destroyMentor($id)
    {
        $mentor = \App\Mentor::where('idMentor', '=', $id)->first();
        $mentor_skill = \App\MentorSkill::where('idMentor', '=', $id)->first();
        $candidate_chat = \App\MentorCandidateChat::where('senderType','=', 'mentor')->where('idSender','=',$id)->orWhere('receiverType','=','mentor')->where('idReceiver','=',$id)->get();
        if($candidate_chat->count() > 0){
            return redirect()->back()->with('message', 'You can not delete this Mentor Because Candidate already chat with this Mentor!');
        }
        else{
            if(!empty($mentor_skill)){$mentor_skill->delete();}
            $mentor->delete();
            flash('Mentor Deleted Successfully');
        }
        return redirect('admin/mentors');
    }

    public function jobDeactivation($id){
      $actived_job =\App\JobSession::where('idJobSession','=',$id)->where('isActive','=','Yes')->whereDate('toDate', '>=',today()->toDateString())->first();
      $actived_job->isActive = 'No';
      $actived_job->update();
      return redirect('/admin/deactivated')->with('message', 'Job Deactivated Successfully');
    }
    public function jobActivation($id){
      $deactived_job =\App\JobSession::where('idJobSession','=',$id)->WhereDate('toDate', '<',today()->toDateString())->first();
      if(!empty($deactived_job)){
            return redirect()->back()->with('message', 'You Can not Activate this Job Because End Date is Expire! Please Edit this Job');
        }
      $deactive_job = \App\JobSession::where('idJobSession','=',$id)->where('isActive','=','No')->where(function($query)
            {
                $query->where('isActive','=','No')
                      ->orWhereDate('toDate', '<',today()->toDateString());
            })->first();
      $deactive_job->isActive ='Yes';
      $deactive_job->save(); 
      return redirect('/admin/activated')->with('message', 'Job Activated Successfully');
    }

    public function jobEdit($id){
        $jobsession = \App\JobSession::where('idJobSession','=',$id)->first();
        return view('admin.edit_job', compact('jobsession'));
    }

    public function jobUpdate(Request $request,$id){
        $jobsession = \App\JobSession::where('idJobSession','=',$id)->first();
        $rules = [
            'startDate' => 'required',
            'toDate' => 'required|after:startDate',
            'isActive' => 'required',
        ];
        $messages =[];
        $this->validate($request, $rules, $messages);
        $jobsession->fill($request->all());
        $jobsession->update();
        return redirect('/admin/activated')->with('message', 'Job Activated Successfully');
    }

    public function saveNotification(){
        
    }
}
