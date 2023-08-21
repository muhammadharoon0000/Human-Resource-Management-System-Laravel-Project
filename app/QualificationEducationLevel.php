<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualificationEducationLevel extends Model
{
    protected $guarded= [];

	public function company(){
		return $this->hasOne('App\company','id','company_id');
	}
}
