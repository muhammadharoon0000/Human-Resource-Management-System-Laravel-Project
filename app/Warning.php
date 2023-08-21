<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{

	protected $fillable = [
		'subject','description', 'company_id','warning_to','warning_type','warning_date','status'
	];

	public function company(){
		return $this->hasOne('App\company','id','company_id');
	}

	public function WarningTo(){
		return $this->hasOne('App\Employee','id','warning_to');
	}

	public function WarningType(){
		return $this->hasOne('App\WarningType','id','warning_type');
	}

	public function setWarningDateAttribute($value)
	{
		$this->attributes['warning_date'] = Carbon::createFromFormat(env('Date_Format'), $value)->format('Y-m-d');
	}

	public function getWarningDateAttribute($value)
	{
		return Carbon::parse($value)->format(env('Date_Format'));
	}
}
