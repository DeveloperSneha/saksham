<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $primaryKey = 'idCompanyProfile';
    protected $table = 'companiesprofile';
    protected $fillable = ['idCompany','companyProfile','idState','idDistrict','location','email','mobile','website'];

    public function company() {
        return $this->belongsTo(Company::class, 'idCompany', 'idCompany');
    }

    public function state() {
        return $this->belongsTo(State::class, 'idState', 'idState');
    }

    public function district() {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }
}