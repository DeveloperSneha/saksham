<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Notifications\MentorResetNotification;
use App\Notifications\MentorActivationNotification;

class Mentor extends Authenticatable {

    use Notifiable;

    protected $guard = 'mentor';
    protected $primaryKey = 'idMentor';
    protected $table = 'mentors';
    protected $fillable = ['firstName', 'lastName', 'email', 'mobile', 'photo', 'personalWebsite', 'facebookUrl', 'twitterUrl', 'linkedinUrl', 'youtubeUrl', 'idGender', 'languages', 'dob', 'idQualification', 'about', 'headline', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        return $this->notify(new MentorResetNotification($token));
    }

    public function sendActivationNotofication() {
        $token = str_random(15);
        $this->confirmation_code = $token;
        $this->save();
        $this->notify(new MentorActivationNotification($token));
    }

    public function mentor_skill() {
        return $this->hasMany(MentorSkill::class, 'idMentor', 'idMentor');
    }
    
    public function qualification() {
        return $this->belongsTo(Qualification::class, 'idQualification', 'idQualification');
    }
    
    public function gender() {
        return $this->belongsTo(Gender::class, 'idGender', 'idGender');
    }

    public function setDobAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['dob'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['dob'] = null;
    }

    public function getDobAttribute($date) {
        // dd($date);
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

}
