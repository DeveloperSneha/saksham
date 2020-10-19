<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateAcademic extends Model
{
    protected $primaryKey = 'idCandidateInfo';
    protected $table = 'candidates_academics';
    protected $fillable = ['idCandidate','idQualification','idUniversity','passedYear','percentage','idMedium','idDistrict'];

	public function candidate() {
        return $this->belongsTo(Candidate::class, 'idCandidate', 'idCandidate');
    }
   
    public function qualification() {
        return $this->belongsTo(Qualification::class, 'idQualification', 'idQualification');
    }

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }

    public function university() {
        return $this->belongsTo(University::class, 'idUniversity', 'idUniversity');
    }

    public function medium() {
        return $this->belongsTo(Medium::class, 'idMedium', 'idMedium');
    }
}
