<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficerDetail extends Model
{
    protected $primaryKey = 'idOfficerDetail';
    protected $table = 'officers_details';
    protected $fillable = ['idJobRole','idDistrict','idOfficer','designation'];

    public function jobrole() {
        return $this->belongsTo(JobRole::class, 'idJobRole', 'idJobRole');
    }

	
    public function officer(){
    	return $this->belongsTo(Officers::class, 'idOfficer','idOfficer');
    }

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }
}
