<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $primaryKey = 'idDistrict';
    protected $table = 'districts';

    public function state() {
        return $this->belongsTo(State::class, 'idState', 'idState');
    }
}