<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlacementQuestionOption extends Model
{
    protected $primaryKey = 'idOption';
    protected $table = 'placementque_options';
    protected $fillable = ['idQuestion','optionText','optionValue','language'];

    public function questions(){
    	return $this->belongsTo(PlacementQuestion::class, 'idQuestion', 'idQuestion');
    }
}
