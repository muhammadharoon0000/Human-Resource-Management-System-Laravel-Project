<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    //
	protected $table = 'role_users';

	public function users()
	{
		return $this->hasMany('App\User','role_users_id');
	}

	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format(env('Date_Format'));
	}
}
