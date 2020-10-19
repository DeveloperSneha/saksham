<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;
class JobController extends CompanyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = \App\Company::where('idCompany','=',Auth::guard('company')->user()->idCompany)->first();
        $sector = ['' => '---Select Sector ---'] + \App\Sector::orderBy('sectorName')->pluck('sectorName', 'idSector')->toArray();
        return view('company.jobpost', compact('company','sector'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_jobs = \App\Job::where('idCompany','=',Auth::guard('company')->user()->idCompany)->get();
        return view('company.jobs', compact('company_jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'idSector' => 'required',
            'idJobRole' => 'required',
            'idExperience' => 'required',
            'idQualification' => 'required',
            'idAgeLimit' => 'required',
            'salary'=> 'required',
            'hrName' => 'required',
            'hrContact' => 'required',
            'vacancies' => 'required',
            'designation' => 'required',
            'salaryNegotiable' => 'required',
            'isActive' => 'required',
            'startDate' =>'required',
            'toDate'=>'required|date|after:startDate',
            'jobDescription'=>'required'
        ];
        
        if (!count($request->job_location) > 0) {

            $rules +=['job_location[]' => 'required'];
        }
        if (!count($request->idState) > 0) {
            $rules +=['idState[]' => 'required'];
        }
        
        $messages = [
          'idSector.required'=>'Please Select Sector first',
          'idJobRole.required'=>'Please Select job role',
          'idExperience.required'=>'Please Select required Experience',
          'idQualification.required'=>'Please Select required Qualification',
          'idAgeLimit.required' => 'Please Select Age Limit.',
          'salary.required' => 'Salary should not be empty',
          'vacancies.required' => 'Vacancies should not be empty',
          'designation.required' => 'Designation should not be empty',
          'HrName.required' => 'HR Name should not be empty',
          'HrContact.required' => 'HR Contact No. should not be empty',
          'idState[].required' => 'Please Select State First',
          'job_location[].required'=>'Please Select District',
          'salaryNegotiable.required' => 'Please Select Salary Negotiable',
          'isActive.required' => 'Please Select Job isActive',
          'startDate.required' => 'Job Start Date should not be empty',
          'jobDescription.required' => 'Job Description should not be empty',
          'toDate.required' => 'Job End Date should not be empty',
          'toDate.after' => 'Job End Date should be greater than start Date',
        ];
        $this->validate($request, $rules, $messages);
        // dd($request->all());
        $job = new \App\Job();             
        $job->fill($request->all());
        $job->idCompany = Auth::guard('company')->user()->idCompany;
        DB::beginTransaction();
        $job->save();
        if (count($request->job_location) > 0) {
            foreach ($request->job_location as $var) {
                if($var !=null && $var != 0){
                $job_location = new \App\JobLocation();      
                $job_location->fill($request->all());
                $job_location->idJob = $job->idJob;
                $job_location->idDistrict = $var;
                $state = \App\District::where('idDistrict','=',$var)->pluck('idState')->first();
                $job_location->idState =$state;
                $job_location->idDistrict = $var;
                $job_location->save();
                }
            }
        }
        $job_session = new \App\JobSession();
        $job_session->fill($request->all());
        $job_session->idJob =$job->idJob;
        $job_session->save();
        DB::commit();
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
                    }
        return redirect('company/jobs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job_details = \App\Job::where('idJob','=',$id)->where('idCompany','=',Auth::guard('company')->user()->idCompany)->first();
        $jobloc =\App\JobLocation::where('idJob','=',$id)->get()->pluck('idDistrict')->toArray();
        return view('company.view_job', compact('job_details','jobloc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $job = \App\Job::where('idJob', '=', $id)->first();
      $rules = [
          'idSector' => 'required',
          'idJobRole' => 'required',
          'idExperience' => 'required',
          'idQualification' => 'required',
          'idAgeLimit' => 'required',
          'salary'=> 'required',
          'hrName' => 'required',
          'hrContact' => 'required',
          'vacancies' => 'required',
          'designation' => 'required',
          'salaryNegotiable' => 'required',
          'isActive' => 'required',
          'startDate' =>'required',
          'toDate'=>'required|date|after:startDate',
          'jobDescription'=>'required'
      ];
      
      if (count($request->job_location) > 0) {
            $rules +=['job_location' => 'required'];
        }
        if (count($request->states) > 0) {
            $rules +=['states' => 'required'];
        }
        
      $messages = [
        'idSector.required'=>'Please Select Sector first',
        'idJobRole.required'=>'Please Select job role',
        'idExperience.required'=>'Please Select required Experience',
        'idQualification.required'=>'Please Select required Qualification',
        'idAgeLimit.required' => 'Please Select Age Limit.',
        'salary.required' => 'Salary should not be empty',
        'idState.required' => 'Please Select State First',
        'job_location.required'=>'Please Select District',
        'salaryNegotiable.required' => 'Please Select Salary Negotiable',
        'isActive.required' => 'Please Select Job isActive',
        'vacancies.required' => 'Vacancies should not be empty',
        'designation.required' => 'Designation should not be empty',
        'HrName.required' => 'HR Name should not be empty',
        'HrContact.required' => 'HR Contact No. should not be empty',
        'startDate.required' => 'Job Start Date should not be empty',
        'jobDescription.required' => 'Job Description should not be empty',
        'toDate.required' => 'Job End Date should not be empty',
          'toDate.after' => 'Job End Date should be greater than start Date',
      ];
      $this->validate($request, $rules, $messages);             
      $job->fill($request->all());
      DB::beginTransaction();
      $job->update();
      $job_session = \App\JobSession::where('idJob','=',$id)->first();
      $job_session->fill($request->all());
      $job_session->update();
      DB::commit();
      return redirect('company/jobs')->with('message', 'Job updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = \App\Job::where('idJob', '=', $id)->first();
        $job_session =\App\Job::where('idJob', '=', $id)->first();
        $candidate_applied = \App\JobApplied::where('idJob', '=', $id)->get();
        if($candidate_applied->count() > 0){
            return redirect()->back()->with('message', 'You Can not Delete this Job Because Candidate Already Applied!');
        }
        else{
            $job_session->delete();
            $job->delete();
            flash('Job Deleted Successfully');
        }
        return redirect('jobs');
    }
    
    public function getActivedJobs()
    {
      $company_jobs =\App\JobSession::with('job')
                    ->whereHas('job', function($query) {
                      $query->where('idCompany', '=', Auth::guard('company')->user()->idCompany);
                    })
                    ->where('isActive','=','Yes')
                    ->whereDate('toDate', '>=', today()->toDateString())
                    ->get();
      return view('company.active_jobs', compact('company_jobs'));
    }

    public function getDeactivedJobs()
    {
       $company_jobs = \App\JobSession::with('job')
        ->whereHas('job', function($query) {
                      $query->where('idCompany', '=', Auth::guard('company')->user()->idCompany);
                    })
        ->where(function($query)
            {
                $query->where('isActive','=','No')
                      ->orWhereDate('toDate', '<', today()->toDateString());
            })
            
        ->get();
        // dd($company_jobs);
        return view('company.deactive_jobs', compact('company_jobs'));
    }

    public function deactivateJob($id){
      $actived_job =\App\JobSession::where('idJobSession','=',$id)->where('isActive','=','Yes')->whereDate('toDate', '>=',today()->toDateString())->first();
      $actived_job->isActive = 'No';
      $actived_job->update();
      return redirect('/company/deactive_jobs')->with('message', 'Job Deactivated Successfully');
    }
    public function activateJob($id){
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
      return redirect('/company/active_jobs')->with('message', 'Job Activated Successfully');
    }

    public function getAppliedJob()
    {
      $job = \App\Job::where('idCompany', '=', Auth::guard('company')->user()->idCompany)->pluck('idJob')->toArray();
      $job_applied =\App\JobApplied::whereIn('idJob',$job)->get();
      return view('company.applied_job', compact('job_applied'));
    }

    public function viewAppliedDetails($id){
      $job_applied =\App\JobApplied::where('idJobApplied','=',$id)->get();
      $candidate_applied =\App\JobApplied::where('idJobApplied','=',$id)->pluck('idCandidate');
      $answer =\App\CandidateAnswer::where('idCandidate','=',$candidate_applied)->first();
      
      return view('company.applied_details', compact('job_applied','answer'));
    }
    
    public function getStateDistricts($id)
    {
        $state_ids = array_map('intval', explode(',', $id));
        $district = \App\District::whereIn('idState',$state_ids)->get()->pluck("districtName", "idDistrict")->toArray();
        return json_encode($district);
    }

    public function editLoc($id)
    {
        $job_details = \App\Job::where('idJob','=',$id)->where('idCompany','=',Auth::guard('company')->user()->idCompany)->first();
        $jobloc =\App\JobLocation::where('idJob','=',$job_details->idJob)->get();
        return view('company.edit_loc', compact('jobloc','job_details'));
    }

    public function updateLoc(Request $request, $id)
    {
        
        $job = \App\Job::where('idJob', '=', $id)->first();
        // $job_location->idJobLocation = $request->idJobLocation;
        $old_ids = $job->joblocation()->pluck('idJobLocation')->toArray();
        // dd($old_ids);
        $job_locations = new \Illuminate\Database\Eloquent\Collection();
        foreach ($request->joblocation as $var) {
            $job_loc = \App\JobLocation::firstOrNew(['idJobLocation' => $request->idJobLocation, 'idDistrict' => $var['idDistrict'], 'idState' => $var['idState'], 'idJob' => $job->idJob]);
            $job_locations->add($job_loc);
        }
        $new_ids = $job_locations->pluck('idJobLocation')->toArray();

         // dd($new_ids);
        $detach = array_diff($old_ids, $new_ids);
        // dd($detach);
        DB::beginTransaction();
        // $job_locations->update();
        \App\JobLocation::whereIn('idJobLocation', $detach)->delete();


        $job->joblocation()->saveMany($job_locations);

        DB::commit();
        return redirect('/company/jobs')->with('message', 'Job Location updated Successfully');
    }
}
