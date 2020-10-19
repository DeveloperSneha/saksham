<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DarpanDistrictWise extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'darpan_district_wise';
    protected $fillable = ['district_id','district', 'training_male', 'training_female', 'trained_male', 'trained_female', 'assessed_male', 'assessed_female', 'certified_male', 'certified_female', 'placed_male', 'placed_female'];
}
