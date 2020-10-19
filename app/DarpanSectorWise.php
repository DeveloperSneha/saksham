<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DarpanSectorWise extends Model
{
    protected $primaryKey = 'sector_id';
    protected $table = 'darpan_sector_wise';
    protected $fillable = ['sector_name', 'training_male', 'training_female', 'trained_male', 'trained_female', 'assessed_male', 'assessed_female', 'certified_male', 'certified_female', 'placed_male', 'placed_female'];
}
