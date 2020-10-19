<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $primaryKey = 'idExperience';
    protected $table = 'experience';
    protected $fillable = ['experience'];
}
