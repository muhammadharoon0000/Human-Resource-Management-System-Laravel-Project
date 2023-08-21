<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    protected $fillable = [
        'company_id',
        'employee_id',
        'department_id',
        'designation_id',
        'customer_experience',
        'marketing',
        'administration',
        'professionalism',
        'integrity',
        'attendance',
        'remarks',
        'date',
    ];

    public function company(){
      return $this->hasOne('App\company','id','company_id');
    }

    public function employee(){
      return $this->hasOne('App\Employee','id','employee_id');
    }

    public function department(){
		  return $this->hasOne('App\department','id','department_id');
	  }

    public function designation(){
		  return $this->hasOne('App\designation','id','designation_id');
    }
}
