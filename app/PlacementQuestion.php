<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlacementQuestion extends Model
{
    protected $primaryKey = 'idQuestion';
    protected $table = 'placement_questions';
    protected $fillable = ['question','questionType'];
}
