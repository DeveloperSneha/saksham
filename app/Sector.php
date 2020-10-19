<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{    
	protected $primaryKey = 'idSector';
    protected $table = 'sector';
    protected $fillable = ['idScheme','sectorName','shortName'];

    public function scheme(){
    	return $this->belongsTo(Scheme::class, 'idScheme', 'idScheme');
    }

    public function jobrole(){
    	return $this->hasMany(JobRole::class, 'idSector','idSector');
    }
}
