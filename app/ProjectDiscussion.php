<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProjectDiscussion extends Model
{
	protected $fillable = [
		'project_discussion','user_id','discussion_attachment','project_id'
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
