<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CandidateAnswer extends Model
{
    protected $primaryKey = 'idAnswer';
    protected $table = 'candidateanswers';
    protected $fillable = ['idCandidate','q1','q2','q3','q4','q5','q6','q7','q8','q9','q10','q11','q12','q13'];

    public function candidate() {
        return $this->belongsTo(Candidate::class, 'idCandidate', 'idCandidate');
    }
}
