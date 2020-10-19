<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminReportController extends Controller
{
    
    public function appliedList(){
        $applied_jobs =DB::table('jobapplied')
                        ->join('jobs','jobapplied.idJob','=','jobs.idJob')
                        ->join('candidates','jobapplied.idCandidate','=','candidates.idCandidate')
                        ->join('jobrole','jobs.idJobRole','=','jobrole.idJobRole')
                        ->join('sector','jobrole.idSector','=','sector.idSector')
                        ->join('companies','jobs.idCompany','=','companies.idCompany')
                        ->select('companyName','fatherName','aadhar','firstName','lastName','candidates.mobile','shortName','jobRoleName','jobapplied.updated_at','idJobApplied','designation')
                        ->get();
        return view('admin.reports.applied',compact('applied_jobs'));
    }

    public function mentorList(){
        $mentors =DB::table('mentors_skills')
                    ->join('mentors','mentors_skills.idMentor','=','mentors.idMentor')
                    ->join('jobrole','mentors_skills.idJobRole','=','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','=','sector.idSector')
                    ->join('experience','mentors_skills.idExperience','=','experience.idExperience')
                    ->join('gender','mentors.idGender','=','gender.idGender')
                    ->where('status','=',1)
                    ->select('firstName','lastName','experienceName','shortName','jobRoleName','genderName','email','mobile','mentors.created_at','photo','mentors.idMentor')                    
                    ->get();
        return view('admin.reports.mentor',compact('mentors'));    
    }

    public function candidateList(){
        $candidates = DB::table('candidates')
                        ->leftjoin('candidates_academics','candidates.idCandidate','=','candidates_academics.idCandidate')
                        ->leftJoin('candidate_course_enrolments','candidates.idCandidate','=','candidate_course_enrolments.idCandidate')
                        ->leftJoin('jobrole','candidate_course_enrolments.idJobRole','=','jobrole.idJobRole')
                        ->leftJoin('sector','jobrole.idSector','=','sector.idSector')
                        ->join('qualifications','candidates_academics.idQualification','=','qualifications.idQualification')
                        ->join('university','candidates_academics.idUniversity','=','university.idUniversity')
                        ->join('districts','candidates_academics.idDistrict','=','districts.idDistrict')
                        ->join('medium','candidates_academics.idMedium','=','medium.idMedium')
                        ->join('gender','candidates.idGender','=','gender.idGender')
                        ->groupBy('candidates.idCandidate')
                        ->select(DB::raw('group_concat(candidates_academics.idQualification) AS qName'),'jobRoleName','shortName','image','candidates.idCandidate','aadhar','mobile','firstName','lastName','fatherName','qName','email','districtName','universityName','mediumName','passedYear','percentage','genderName')
                        ->get();
        return view('admin.reports.candidate',compact('candidates'));
    }

    public function companyList(){
        $companies =DB::table('companies')
                    ->leftjoin('companiesprofile','companies.idCompany','=','companiesprofile.idCompany')
                    ->leftjoin('states','companiesprofile.idState','states.idState')
                    ->leftjoin('districts','companiesprofile.idDistrict','districts.idDistrict')
                    ->where('status','=',1)
                    ->select('companies.idCompany','districtName','stateName','companyName','companies.email','mobile','ownerName','companyProfile','website','location','logo')
                    ->get();
        return view('admin.reports.companies',compact('companies'));
    }

    public function jobList(){
        $companies_job =DB::table('jobsession')
                    ->join('jobs','jobsession.idJob','=','jobs.idJob')
                    ->join('companies','jobs.idCompany','=','companies.idCompany')
                    ->leftjoin('job_location','jobs.idJob','=','job_location.idJob')
                    ->leftjoin('states','job_location.idState','states.idState')
                    ->leftjoin('districts','job_location.idDistrict','districts.idDistrict')
                    ->join('jobrole','jobs.idJobRole','=','jobrole.idJobRole')
                    ->join('sector','jobrole.idSector','=','sector.idSector')
                    ->join('experience','jobs.idExperience','=','experience.idExperience')
                    ->join('qualifications','jobs.idQualification','=','qualifications.idQualification')
                    ->join('age_limit','jobs.idAgeLimit','=','age_limit.idAgeLimit')
                    ->select('jobs.idJob','districtName','stateName','companyName','hrName','hrContact','ownerName','jobDescription','designation','qName','vacancies','salary','startDate','toDate','age','isActive','shortName','jobRoleName','experienceName')
                    ->get();
        return view('admin.reports.jobs',compact('companies_job'));
    }
}