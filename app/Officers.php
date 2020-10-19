<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officers extends Model
{
    protected $primaryKey = 'idOfficer';
    protected $table = 'officers';
    protected $fillable = ['office', 'name','designation','telephone','mobile','email'];
}

    