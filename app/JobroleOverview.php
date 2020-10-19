<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobroleOverview extends Model
{
    protected $primaryKey = 'idOverview';
    protected $table = 'jobrole_overview';
    protected $fillable = ['idJobRole','jobRoleCode','jobRoleOverview','jobRoleAbout','minQualification','maxQualification','minAge','maxAge','experience','trainingCenters','duration','carrerOppurtunities','jobRoleImage','routeName','language'];

    public function jobrole() {
        return $this->belongsTo(JobRole::class, 'idJobRole', 'idJobRole');
    }
}
