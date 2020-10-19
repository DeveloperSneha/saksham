<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkActive($path, $active = 'active') {
    if (is_string($path)) {
        return request()->is($path) ? $active : '';
    }
    foreach ($path as $str) {
        if (checkActive($str) == $active)
            return $active;
    }
}

function today_date() {
    return Carbon\Carbon::today()->format('Y-m-d');
}

function yesterday_date() {
    return Carbon\Carbon::yesterday()->format('Y-m-d');
}

function tomorrow_date() {
    return Carbon\Carbon::tomorrow()->format('Y-m-d');
}

function deny($redirect = '') {
    if (strlen($redirect) > 0) {
        return redirect($redirect);
    } else {
//  abort(403);
        flash()->warning("You don't have access to this resource!!");
    }
    return redirect()->back();
}

function getMentorPrice(){
    $price = [
        'Free'=>'Free'
    ];
    return $price;
}

function getLanguages(){
    $lang = [
        'English' => 'English',
        'Hindi' => 'Hindi',
        'Other' => 'Others',
    ];
    return $lang;
} 


function getGender(){
    $gender = ['' => '--- Select Gender ---'] + \App\Gender::orderBy('idGender')->pluck('genderName', 'idGender')->toArray();
    return $gender;
}  

function getMedium(){
    $medium =['' => '--- Medium ---'] + \App\Medium::orderBy('idMedium')->pluck('mediumName', 'idMedium')->toArray();
    return $medium;
}

function getSalaryNegotiable(){
    $salary = [
        ''  => '--Select Salary Negotiable --',
        'No'=>'No',
        'Yes'=>'Yes'
    ];
    return $salary;
}

function isActive(){
    $active =[
        ''  => '--Select isActive --',
        'Yes' => 'Yes',
        'No' => 'No',
    ];
    return $active;
}

function getMaritalStatus() {
    $marital = ['' => '--- Select Marital Status ---'] + \App\MaritalStatus::orderBy('idStatus')->pluck('status', 'idStatus')->toArray();
    return $marital;
}

function getDisability() {
    $disabled = ['' => '--- Select Any Disability ---'] + \App\Disability::orderBy('idDisabled')->pluck('status', 'idDisabled')->toArray();
    return $disabled;
}

function getAgeLimit() {
    $age = ['' => '--- Select Age Limit ---'] + \App\AgeLimit::orderBy('idAgeLimit')->pluck('age', 'idAgeLimit')->toArray();
    return $age;
} 

function getQualifications() {
    $quali = ['' => '- Select Higher Qualification -'] + \App\Qualification::orderBy('idQualification')->pluck('qName', 'idQualification')->toArray();
    return $quali;
} 

function Qualifications() {
    $quali = \App\Qualification::orderBy('idQualification')->pluck('qName', 'idQualification')->toArray();
    return $quali;
} 

function university() {
    $uni = ['' => '--- Select University / Board ---'] + \App\University::orderBy('idUniversity')->pluck('universityName', 'idUniversity')->toArray();
    return $uni;
} 

function Experiences() {
    $experience = \App\Experience::orderBy('idExperience')->pluck('experienceName', 'idExperience')->toArray();
    return $experience;
}

function getExperience() {
    $experience = ['' => '--- Select Experience ---'] +\App\Experience::orderBy('idExperience')->pluck('experienceName', 'idExperience')->toArray();
    return $experience;
}

function getStates() {
    $states = \App\State::orderBy('stateName')->pluck('stateName', 'idState')->toArray();
    return $states;
} 
function getDistricts() {
    $districts = \App\District::orderBy('districtName')->pluck('districtName', 'idDistrict')->toArray();
    return $districts;
}
function states() {
    $states = ['' => '---Select State---'] + \App\State::orderBy('stateName')->pluck('stateName', 'idState')->toArray();
    return $states;
} 
function districts() {
    $districts = ['' => '---Select District---'] + \App\District::orderBy('districtName')->pluck('districtName', 'idDistrict')->toArray();
    return $districts;
}

function subdistricts() {
    $subdistrict = ['' => '---Select---'] + \App\SubDistrict::orderBy('subDistrictName')->get()->pluck('subDistrictName', 'idSubDistrict')->toArray();
    return $subdistrict;
}

function placemntQuestions(){
    $ques = \App\PlacementQuestion::orderBy('idQuestion')->get();
    return $ques;
}

function sector(){
    $sector = ['' => '---Select Sector ---'] + \App\Sector::orderBy('sectorName')->pluck('sectorName', 'idSector')->toArray();
    return $sector;
}
function jobrole(){
    $job_role = ['' => '---Select Job Role ---'] +\App\JobRole::orderBy('jobRoleName')->pluck('jobRoleName', 'idJobRole')->toArray();
    return $job_role;
}