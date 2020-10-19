<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $primaryKey = 'idStatus';
    protected $table = 'marital_status';
    protected $fillable = ['status'];
}
