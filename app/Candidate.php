<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CandidateResetNotification;
use App\Notifications\CandidateActivationNotification;

class Candidate  extends Authenticatable
{
    use Notifiable;

    protected $guard = 'candidate';
    
    protected $primaryKey = 'idCandidate';
    protected $table = 'candidates';
    protected $fillable = ['type','firstName','lastName','fatherName','motherName','dob','idGender','mobile','maritalStatus','idDisabled','email','aadhar','pan','image','email','tempState','tempDistrict','tempSubDistrict','tempAddress','tempPincode','pincode','idState','idDistrict','idSubDistrict','address'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        return $this->notify(new CandidateResetNotification($token));
    }

    public function sendActivationNotofication() {
        $token = str_random(15);
        $this->confirmation_code = $token;
        $this->save();
        $this->notify(new CandidateActivationNotification($token));
    }

    public function tempstate() {
        return $this->belongsTo(State::class, 'tempState', 'idState');
    }

    public function tempdistrict() {
        return $this->belongsTo(District::class, 'tempDistrict', 'idDistrict');
    }

    public function tempsubdistrict() {
        return $this->belongsTo(SubDistrict::class, 'tempSubDistrict', 'idSubDistrict');
    }

    public function state() {
        return $this->belongsTo(State::class, 'idState', 'idState');
    }

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }

    public function subdistrict() {
        return $this->belongsTo(SubDistrict::class, 'idSubDistrict', 'idSubDistrict');
    }
    
    public function marital_status() {
        return $this->belongsTo(MaritalStatus::class, 'maritalStatus', 'idStatus');
    }

    public function disabled() {
        return $this->belongsTo(Disability::class, 'idDisabled', 'idDisabled');
    }

    public function gender() {
        return $this->belongsTo(Gender::class, 'idGender', 'idGender');
    }

    public function academics() {
        return $this->hasMany(CandidateAcademic::class, 'idCandidate', 'idCandidate');
    }

    public function jobapplied() {
        return $this->hasMany(JobApplied::class, 'idCandidate', 'idCandidate');
    }

    public function enrolled_course() {
        return $this->hasOne(CandidateCourseEnroll::class, 'idCandidate', 'idCandidate');
    }

    public function candidate_answer() {
        return $this->hasOne(CandidateAnswer::class, 'idCandidate', 'idCandidate');
    }
}
