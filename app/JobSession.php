<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JobSession extends Model
{
    protected $primaryKey = 'idJobSession';
    protected $table = 'jobsession';
    protected $fillable = ['startDate','toDate','idJob','isActive'];

	public function setStartDateAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['startDate'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['startDate'] = null;
    }

    public function getStartDateAttribute($date) {
        // dd($date);
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

    public function setToDateAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['toDate'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['toDate'] = null;
    }

    public function getToDateAttribute($date) {
        // dd($date);
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

    public function job() {
        return $this->belongsTo(Job::class, 'idJob', 'idJob');
    }
}
