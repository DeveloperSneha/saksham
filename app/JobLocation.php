<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    protected $primaryKey = 'idJobLocation';
    protected $table = 'job_location';
    protected $fillable = ['idJob','idState','idDistrict'];
	
	public function job() {
        return $this->belongsTo(Jobs::class, 'idJob', 'idJob');
    }

    public function state() {
        return $this->belongsTo(State::class, 'idState', 'idState');
    }

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }



    
}
