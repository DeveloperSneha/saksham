<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $primaryKey = 'idVillage';
    protected $table = 'villages';

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }

    public function sub_district() {
        return $this->belongsTo(SubDistrict::class, 'idSubDistrict', 'idSubDistrict');
    }
}
