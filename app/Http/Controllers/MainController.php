<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Verhoeff;
use DB;
use Auth;
use Carbon\Carbon;

class MainController extends Controller
{

    public function index()
    {
        
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        $notifications = \App\Notifications::where('status','=',1)->orderBy('idNotification')->get();
        $darpan_sector_wise = DB::table('darpan_sector_wise')
                            ->select(DB::raw('(SUM(training_male) + SUM(training_female)) as Total_training , (SUM(trained_male) + SUM(trained_female)) as Total_trained , (SUM(assessed_male) + SUM(assessed_female)) as Total_assessed , (SUM(certified_male) + SUM(certified_female)) as Total_certified , (SUM(placed_male) + SUM(placed_female)) as Total_placed'))
                            ->get();
        $darpan_data = \App\DarpanSectorWise::select('sector_name','training_male','training_female')->get();
        // dd($darpan_data);
        return view('pages.home', compact('notifications','darpan_sector_wise','schemes','darpan_data'));
    } 

    public function aboutUs()
    {
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        return view('pages.about_us', compact('schemes'));
    }

    public function scroll()
    {
        return view('pages.scroll');
    }

    public function viewJobRole($id_scheme)
    {
        $scheme = \App\Scheme::where('idScheme','=',$id_scheme)->first();
        $job_overview = DB::table('jobrole_overview')
                        ->join('jobrole','jobrole_overview.idJobRole','jobrole.idJobRole')
                        ->join('sector','jobrole.idSector','sector.idSector')
                        ->where('sector.idScheme','=',$id_scheme)
                        ->select('jobrole_overview.idJobRole','jobRoleName','jobRoleImage')
                        ->get();
        return view('pages.jobrole', compact('scheme','job_overview'));
    }

    public function viewJobRoleOverview($id_scheme, $id_jobrole)
    {
        $scheme = \App\Scheme::where('idScheme','=',$id_scheme)->first();
        $jobrole_overview =\App\JobroleOverview::where('idJobRole','=',$id_jobrole)->first();
        return view('pages.jobrole_overview', compact('scheme','jobrole_overview'));
    }

    public function exploreCourses()
    {
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        $explore_course = \App\OfficerDetail::groupBy('idDistrict')->get();
        return view('pages.explore_course', compact('schemes','explore_course'));        
    }

    public function viewSchemeCourses($id)
    {
       $schemes = \App\Scheme::orderBy('idScheme')->get();
       $jobrole = DB::table('jobrole')
                        ->join('sector','jobrole.idSector','sector.idSector')
                        ->join('schemes','sector.idScheme','schemes.idScheme')
                        ->where('sector.idScheme','=',$id)
                        ->get()->pluck('idJobRole')->toArray();
       $explore_course = \App\OfficerDetail::whereIn('idJobRole',$jobrole)->get();
       return view('pages.explore_course', compact('schemes','explore_course'));       
    }

    public function viewDistrictCourses($id)
    {
      $schemes = \App\Scheme::orderBy('idScheme')->get();
      $explore_course = \App\OfficerDetail::where('idDistrict','=',$id)->get();
      return view('pages.explore_course', compact('schemes','explore_course'));
    }

    public function getMentors()
    {
        $lang_var =[];
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        $mentor_skills =\App\MentorSkill::groupBy('idJobRole')->pluck('idMentor')->toArray();
        $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        return view('mentor.home', compact('mentors','schemes','lang_var'));
    }
    
    public function getSectorWiseMentors($id)
    {
        $lang_var =[];
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        $mentor_skills =\App\MentorSkill::groupBy('idJobRole')->pluck('idMentor')->toArray();
        $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('sector.idScheme','=',$id)
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        return view('mentor.home', compact('mentors','schemes','lang_var'));
    }

    public function getFilterWiseMentors(Request $request)
    {
        $lang_var =[];
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        $mentor_skills =\App\MentorSkill::groupBy('idJobRole')->pluck('idMentor')->toArray();
        if($request->has('languages') && $request->languages != null && !$request->has('graduation') && !$request->has('experience')){
            $lang = implode (", ", $request->languages);
            $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('mentors.languages','LIKE','%'. $lang .'%')
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        }
        else if($request->has('graduation') && $request->graduation != null && !$request->has('languages') && !$request->has('experience')){
            $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('mentors.idQualification','=',$request->graduation)
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        }
        else if($request->has('experience') && $request->experience != null && !$request->has('languages') && !$request->has('graduation')){
            $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('idExperience','=',$request->experience)
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        }
        else if($request->has('experience') && $request->has('languages') && !$request->has('graduation')){
            $lang = implode (", ", $request->languages);
            $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('idExperience','=',$request->experience)
                    ->where('mentors.languages','LIKE','%'. $lang .'%')
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        }
        else if(!$request->has('experience') && $request->has('languages') && $request->has('graduation')){
            $lang = implode (", ", $request->languages);
            $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('mentors.idQualification','=',$request->graduation)
                    ->where('mentors.languages','LIKE','%'. $lang .'%')
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        }
        else if($request->has('experience') && !$request->has('languages') && $request->has('graduation')){
            $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('idExperience','=',$request->experience)
                    ->where('mentors.idQualification','=',$request->graduation)
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();
        }
        else if($request->has('experience') && $request->has('languages') && $request->has('graduation')){
            $lang = implode (", ", $request->languages);
            $mentors = DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','sector.idSector')
                    ->whereIn('mentors.idMentor',$mentor_skills)
                    ->where('idExperience','=',$request->experience)
                    ->where('mentors.idQualification','=',$request->graduation)
                    ->where('mentors.languages','LIKE','%'. $lang .'%')
                    ->select('photo','firstName','lastName','shortName','jobRoleName','mentors.idMentor','languages','headline','about')
                    ->get();

        }
        if($request->languages) {
            $lang_var =$request->languages;
        }
        return view('mentor.home', compact('mentors','schemes','lang_var'));
    }

    public function getMentorDetails($id){
        $mentor =\App\Mentor::where('idMentor','=',$id)->first();
        $mentor_sector =\App\MentorSkill::where('idMentor','=',$id)->pluck('idJobRole')->toArray();
        $sector =\App\JobRole::whereIn('idJobRole',$mentor_sector)->pluck('idSector')->toArray();
        $jobrole = \App\JobRole::whereIn('idSector',$sector)->pluck('idJobRole')->toArray();
        $similar_mentor =\App\MentorSkill::whereIn('idJobRole',$jobrole)->get();
        return view('mentor.view',compact('mentor','similar_mentor'));
    }

    public function getCompany()
    {
        $schemes = \App\Scheme::orderBy('idScheme')->get();   
        $company_jobs = DB::table('job_location')
                ->join('jobs','job_location.idJob','jobs.idJob')
                ->join('jobsession','jobs.idJob','=','jobsession.idJob')
                ->join('jobrole','jobs.idJobRole','jobrole.idJobRole')
                ->join('companies','jobs.idCompany','companies.idCompany')
                ->join('qualifications','jobs.idQualification','qualifications.idQualification')
                ->join('districts','job_location.idDistrict','districts.idDistrict')
                ->join('sector','jobrole.idSector','sector.idSector')
                ->join('schemes','sector.idScheme','schemes.idScheme')
                ->where('toDate','>',today())
                ->where('isActive','=','Yes')
                ->groupBy('jobs.idJob')
                ->select(DB::raw('group_concat(districtName) AS districtName'),'logo','companyName','jobRoleName','sectorName','qName','jobDescription','shortName','jobs.idJob','designation','vacancies','salary')
                ->orderBy('idJob','DESC')
                ->get();
        return view('company.home',compact('schemes','company_jobs','jobs'));
    }
    
    public function getSchemeWiseJobs($id)
    {
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        $sector =\App\Sector::where('idScheme','=',$id)->pluck('idSector')->toArray();
        $job_role = \App\JobRole::whereIn('idSector',$sector)->pluck('idJobRole')->toArray();
        $jobs = \App\Job::whereIn('idJobRole',$job_role)->pluck('idJob')->toArray();
        $company_jobs = DB::table('job_location')
                ->join('jobs','job_location.idJob','jobs.idJob')
                ->join('jobsession','jobs.idJob','=','jobsession.idJob')
                ->join('jobrole','jobs.idJobRole','jobrole.idJobRole')
                ->join('companies','jobs.idCompany','companies.idCompany')
                ->join('qualifications','jobs.idQualification','qualifications.idQualification')
                ->join('districts','job_location.idDistrict','districts.idDistrict')
                ->join('sector','jobrole.idSector','sector.idSector')
                ->join('schemes','sector.idScheme','schemes.idScheme')
                ->whereIn('jobs.idJob',$jobs)
                ->where('toDate','>',today())
                ->where('isActive','=','Yes')
                ->groupBy('jobs.idJob')
                ->select(DB::raw('group_concat(districtName) AS districtName'),'logo','companyName','jobRoleName','sectorName','qName','jobDescription','shortName','jobs.idJob','designation','vacancies','salary')
                ->orderBy('idJob','DESC')
                ->get();
        return view('company.home',compact('schemes','company_jobs'));
    }
    public function getSectorWiseJobs($id)
    {
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        $job_role = \App\JobRole::where('idSector','=',$id)->pluck('idJobRole')->toArray();
        $jobs = \App\Job::whereIn('idJobRole',$job_role)->pluck('idJob')->toArray();
        $company_jobs = DB::table('job_location')
                ->join('jobs','job_location.idJob','jobs.idJob')
                ->join('jobsession','jobs.idJob','=','jobsession.idJob')
                ->join('jobrole','jobs.idJobRole','jobrole.idJobRole')
                ->join('companies','jobs.idCompany','companies.idCompany')
                ->join('qualifications','jobs.idQualification','qualifications.idQualification')
                ->join('districts','job_location.idDistrict','districts.idDistrict')
                ->join('sector','jobrole.idSector','sector.idSector')
                ->join('schemes','sector.idScheme','schemes.idScheme')
                ->whereIn('jobs.idJob',$jobs)
                ->where('toDate','>',today())
                ->where('isActive','=','Yes')
                ->groupBy('jobs.idJob')
                ->select(DB::raw('group_concat(districtName) AS districtName'),'logo','companyName','jobRoleName','sectorName','qName','jobDescription','shortName','jobs.idJob','designation','vacancies','salary')
                ->orderBy('idJob','DESC')
                ->get();
        return view('company.home',compact('schemes','company_jobs'));
    }

    public function getOtherSchemes()
    {
        $sectors =\App\Sector::orderBy('idSector')->get();
        return view('company.other_sch',compact('sectors'));
    }
    

    public function getStateWiseJobs(Request $request)
    {
        $schemes = \App\Scheme::orderBy('idScheme')->get();
        if($request->has('idDistrict') && $request->idDistrict != null){
            $jobs=\App\JobLocation::where('idDistrict','=',$request->idDistrict)->pluck('idJob')->toArray();
            $company_jobs = DB::table('job_location')
                ->join('jobs','job_location.idJob','jobs.idJob')
                ->join('jobsession','jobs.idJob','=','jobsession.idJob')
                ->join('jobrole','jobs.idJobRole','jobrole.idJobRole')
                ->join('companies','jobs.idCompany','companies.idCompany')
                ->join('qualifications','jobs.idQualification','qualifications.idQualification')
                ->join('districts','job_location.idDistrict','districts.idDistrict')
                ->join('sector','jobrole.idSector','sector.idSector')
                ->join('schemes','sector.idScheme','schemes.idScheme')
                ->whereIn('jobs.idJob',$jobs)
                ->where('toDate','>',today())
                ->where('isActive','=','Yes')
                ->groupBy('jobs.idJob')
                ->select(DB::raw('group_concat(districtName) AS districtName'),'logo','companyName','jobRoleName','sectorName','qName','jobDescription','shortName','jobs.idJob','designation','vacancies','salary')
                ->orderBy('idJob','DESC')
                ->get();
        }else{
            $jobs =\App\JobLocation::where('idState','=',$request->idState)->pluck('idJob')->toArray();
            $company_jobs = DB::table('job_location')
                ->join('jobs','job_location.idJob','jobs.idJob')
                ->join('jobsession','jobs.idJob','=','jobsession.idJob')
                ->join('jobrole','jobs.idJobRole','jobrole.idJobRole')
                ->join('companies','jobs.idCompany','companies.idCompany')
                ->join('qualifications','jobs.idQualification','qualifications.idQualification')
                ->join('districts','job_location.idDistrict','districts.idDistrict')
                ->join('sector','jobrole.idSector','sector.idSector')
                ->join('schemes','sector.idScheme','schemes.idScheme')
                ->whereIn('jobs.idJob',$jobs)
                ->where('toDate','>',today())
                ->where('isActive','=','Yes')
                ->groupBy('jobs.idJob')
                ->select(DB::raw('group_concat(districtName) AS districtName'),'logo','companyName','jobRoleName','sectorName','qName','jobDescription','shortName','jobs.idJob','designation','vacancies','salary')
                ->orderBy('idJob','DESC')
                ->get();
        }
        return view('company.home',compact('schemes','company_jobs'));
    }
    
    public function getJobDetails($id)
    {
        $job_details =\App\JobSession::where('idJob','=',$id)->first();
        return view('company.job_details',compact('job_details'));
    }

    public function getSakshamDarpan()
    {
        $darpan_sector_wise = DB::table('darpan_sector_wise')
                            ->select(DB::raw('(SUM(training_male) + SUM(training_female)) as Total_training , (SUM(trained_male) + SUM(trained_female)) as Total_trained , (SUM(assessed_male) + SUM(assessed_female)) as Total_assessed , (SUM(certified_male) + SUM(certified_female)) as Total_certified , (SUM(placed_male) + SUM(placed_female)) as Total_placed'))
                            ->get();
        $darpan_sector = \App\DarpanSectorWise::select('sector_name','training_male','training_female')->get();
        $darpan_district = \App\DarpanDistrictWise::select('district_id','training_male','training_female')->get();
        $darpan_jobrole = \App\DarpanJobRoleWise::select('sector_name','training_male','training_female')->get();
        // dd($darpan_data);
        return view('admin.home', compact('darpan_sector_wise','darpan_sector','darpan_district','darpan_jobrole'));
    }

    public function viewOfficersContact()
    {
        $officers_contact =\App\OfficersContact::orderBy('name')->get();
        return view('pages.contact_officers', compact('officers_contact'));
    }

    public function getCandidatewithAadhar(Request $request){
        $rules = [];
        $messages = [];
        if ($request->aadhar != null) {
            if (Verhoeff::validate($request->aadhar) === false) {
                $rules += ['aadharabc' => 'required'];
                $messages += ['aadharabc.required' => 'Aadhar Number Is Not vaild'];
            }
        }
        $this->validate($request, $rules, $messages);
        $candidate = \App\Candidate::where('aadhar','=',$request->aadhar)->first();
        return response(json_encode($candidate));
    }

    public function getCandidatewithMobileNo(Request $request){
        $candidate = \App\Candidate::where('mobile','=',$request->mobile)->first();
        return response(json_encode($candidate));
    }

    public function getDistricts($id){
        $district = \App\District::where('idState','=',$id)->pluck("districtName", "idDistrict")->toArray();
        return response(json_encode($district));
    }

    public function getSubdistricts($id){
        $sd = \App\SubDistrict::where('idDistrict','=',$id)->pluck("subDistrictName", "idSubDistrict")->toArray();
        return response(json_encode($sd));
    }

    public function getJobRole($id){
        $jobrole = \App\JobRole::where('idSector','=',$id)->pluck("jobRoleName", "idJobRole")->toArray();
        return response(json_encode($jobrole));
    }

    public function getUniversity($id){
        $university = \App\University::where('idState','=',$id)->pluck("universityName", "idUniversity")->toArray();
        return response(json_encode($university));
    }

    public function showAluminiForm(){
        $sectors = \App\Sector::orderBy('sectorName')->get()->pluck('sectorName','idSector')->toArray();
        return view('candidate.alumini', compact('sectors'));
    }

    public function saveAlumini(Request $request){
        $alumini = new \App\CandidateAlumini();             
        $alumini->fill($request->all());
        $alumini->save();
        session()->flash('message','Thank you, we have saved your details.');
        return redirect('alumini');
    }

    public function getCandidateDetails($id){
        $candidate =\App\Candidate::where('idCandidate','=',$id)->first();
        return view('mentor.candidate_details',compact('candidate'));
    }
    
    public function generatePassword(){
        $candidate =\App\Candidate::whereNull('pass')->get();
        foreach($candidate as $var){
        $n = substr($var->firstName, 0, 4);
        $an = substr($var->mobile, -4);
        $password = ($n . $an);
        $var->pass =$password;
        $var->password = bcrypt($password);
        $var->update();
        }
    }
}
