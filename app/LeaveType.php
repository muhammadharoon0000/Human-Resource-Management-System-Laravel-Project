<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
	protected $fillable = [
		'leave_type','allocated_day'
	];


}
