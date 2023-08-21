<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualificationLanguage extends Model
{
	protected $guarded= [];

	public function company(){
		return $this->hasOne('App\company','id','company_id');
	}
}
