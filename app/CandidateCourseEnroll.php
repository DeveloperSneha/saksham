<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateCourseEnroll extends Model
{
    protected $primaryKey = 'idEnrolment';
    protected $table = 'candidate_course_enrolments';
    protected $fillable = ['idCandidate','idJobRole','status'];

	public function candidate() {
        return $this->belongsTo(Candidate::class, 'idCandidate', 'idCandidate');
    }

    public function jobrole() {
        return $this->belongsTo(JobRole::class, 'idJobRole', 'idJobRole');
    }

}
