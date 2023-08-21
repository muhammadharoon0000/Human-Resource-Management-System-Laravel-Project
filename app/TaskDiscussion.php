<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaskDiscussion extends Model
{
	protected $fillable = [
		'task_discussion','user_id','task_id'
	];

	public function task(){
		return $this->hasOne('App\Task','id','task_id');
	}
	public function User(){
		return $this->hasOne('App\User','id','user_id');
	}

	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format(env('Date_Format').'--H:i');
	}
}
