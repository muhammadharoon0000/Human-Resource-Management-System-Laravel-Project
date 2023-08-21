<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TicketComments extends Model
{
	protected $fillable = [
		'ticket_id', 'ticket_comments','user_id'
	];

	public function ticket(){
		return $this->hasOne('App\SupportTicket','id','ticket_id');
	}


	public function user(){
		return $this->hasOne('App\User','id','user_id');
	}

	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format(env('Date_Format').'--H:i');
	}

}
