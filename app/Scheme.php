<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{    
	protected $primaryKey = 'idScheme';
    protected $table = 'schemes';
    protected $fillable = ['SchemeCode', 'SchemeName', 'SchemeOverview', 'SchemeImage', 'SchemeIcon', 'routeName', 'flipBooks', 'flipImagesCount'];

    public function sector(){
    	return $this->hasMany(Sector::class, 'idScheme','idScheme');
    }
}
