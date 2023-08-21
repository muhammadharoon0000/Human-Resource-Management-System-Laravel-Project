<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
	protected $fillable = [
		'status_title','employee_id'
	];
}
