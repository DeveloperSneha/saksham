<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplied extends Model
{
    protected $primaryKey = 'idJobApplied';
    protected $table = 'jobapplied';
    protected $fillable = ['idCandidate','idJob'];

    public function candidate() {
        return $this->belongsTo(Candidate::class, 'idCandidate', 'idCandidate');
    }
    
	public function job() {
        return $this->belongsTo(Job::class, 'idJob', 'idJob');
    }
}
