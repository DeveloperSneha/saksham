<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorAnswer extends Model
{
    protected $primaryKey = 'sno';
    protected $table = 'sector_answers';
    protected $fillable = ['idCandidate','q4'];

    public function candidate() {
        return $this->belongsTo(Candidate::class, 'idCandidate', 'idCandidate');
    }

    public function scheme(){
    	return $this->belongsTo(Scheme::class, 'q4', 'idScheme');
    }
}
