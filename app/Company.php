<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CompanyResetNotification;
use App\Notifications\CompanyActivationNotification;


class Company extends Authenticatable {

    use Notifiable;

    protected $guard = 'company';
    protected $primaryKey = 'idCompany';
    protected $login_fy = '';
    protected $table = 'companies';
    protected $fillable = ['companyName', 'ownerName', 'email','logo', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sendPasswordResetNotification($token) {
        return $this->notify(new CompanyResetNotification($token));
    }

    public function sendActivationNotofication() {
        $token = str_random(15);
        $this->confirmation_code = $token;
        $this->save();
        $this->notify(new CompanyActivationNotification($token));
    }

    public function companyprofile() {
        return $this->hasOne(CompanyProfile::class, 'idCompany', 'idCompany');
    }
    
     public function jobs() {
        return $this->hasMany(Job::class, 'idCompany', 'idCompany');
    }

}
