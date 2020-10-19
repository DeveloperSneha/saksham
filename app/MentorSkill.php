<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorSkill extends Model
{
    protected $primaryKey = 'idMentorSkill';
    protected $table = 'mentors_skills';
    protected $fillable = ['idMentor','idJobRole','idExperience'];

    public function Mentor() {
        return $this->belongsTo(Mentor::class, 'idMentor', 'idMentor');
    }

    public function jobrole() {
        return $this->belongsTo(JobRole::class, 'idJobRole', 'idJobRole');
    }

    public function experience() {
        return $this->belongsTo(Experience::class, 'idExperience', 'idExperience');
    }
}

