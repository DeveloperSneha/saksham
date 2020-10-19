<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
    protected $primaryKey = 'idJobRole';
    protected $table = 'jobrole';
    protected $fillable = ['idSector','jobRoleName'];


    public function sector() {
        return $this->belongsTo(Sector::class, 'idSector', 'idSector');
    }

    public function job(){
    	return $this->hasMany(Job::class, 'idJobRole','idJobRole');
    }
}
