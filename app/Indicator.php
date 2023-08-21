<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'company_id',
        'designation_id',
        'department_id',
        'customer_experience',
        'marketing',
        'administrator',
        'professionalism',
        'integrity',
        'attendance',
        'added_by',
    ];

    public function designation(){
		return $this->hasOne('App\designation','id','designation_id');
    }

    public function company(){
		return $this->hasOne('App\company','id','company_id');
    }
    
    public function department(){
		return $this->hasOne('App\department','id','department_id');
	}
}
