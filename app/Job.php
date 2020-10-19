<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = 'idJob';
    protected $table = 'jobs';
    protected $fillable = ['idJobRole','idCompany','jobDescription','idQualification','idAgeLimit','vacancies','hrName','hrContact','designation','idExperience','salary','salaryNegotiable','idDistrict','actualLocation','status'];

	public function company() {
        return $this->belongsTo(Company::class, 'idCompany', 'idCompany');
    }
	
	public function jobrole() {
        return $this->belongsTo(JobRole::class, 'idJobRole', 'idJobRole');
    }

    public function experience() {
        return $this->belongsTo(Experience::class, 'idExperience', 'idExperience');
    }

    public function qualification() {
        return $this->belongsTo(Qualification::class, 'idQualification', 'idQualification');
    }

    public function state() {
        return $this->belongsTo(State::class, 'idState', 'idState');
    }

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }

    public function agelimit() {
        return $this->belongsTo(AgeLimit::class, 'idAgeLimit', 'idAgeLimit');
    } 

    public function jobsession() {
        return $this->hasOne(JobSession::class, 'idJob', 'idJob');
    }
    
    public function joblocation() {
        return $this->hasMany(JobLocation::class, 'idJob', 'idJob');
    } 



    
}
