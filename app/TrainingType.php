<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
{
	protected $fillable = [
		'type','company_id','status'
	];
}
