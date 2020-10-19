<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DarpanJobRoleWise extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'darpan_job_role_wise';
    protected $fillable = ['sector_id','sector','job_role_id','job_role', 'training_male', 'training_female', 'trained_male', 'trained_female', 'assessed_male', 'assessed_female', 'certified_male', 'certified_female', 'placed_male', 'placed_female'];
}
