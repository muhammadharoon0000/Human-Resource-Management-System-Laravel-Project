<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeContact extends Model
{
	protected $guarded=[];

	public function employee(){
		return $this->hasOne('App\Employee','id','employee_id');
	}
}
