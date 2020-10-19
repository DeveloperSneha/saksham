<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateAlumini extends Model
{
    protected $primaryKey = 'idAlumini';
    protected $table = 'candidates_alumini';
    protected $fillable = ['candidateName','fatherName','email','mobile','idJobRole','passedYear'];

	public function jobrole() {
        return $this->belongsTo(JobRole::class, 'idJobRole', 'idJobRole');
    }
   
}
