<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
	protected $fillable = [
		'file_title','user_id','file_attachment','file_description','project_id'
	];

	public function project(){
		return $this->hasOne('App\Project','id','project_id');
	}
	public function User(){
		return $this->hasOne('App\User','id','user_id');
	}

	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format(env('Date_Format').'--H:i');
	}
}
