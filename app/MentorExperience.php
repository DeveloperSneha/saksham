<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorExperience extends Model
{
    protected $primaryKey = 'idMExperience';
    protected $table = 'mentor_experience';
    protected $fillable = ['experience'];
}
