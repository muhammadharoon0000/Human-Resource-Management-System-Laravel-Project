<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
	protected $fillable = [
		'method_name','company_id','payment_percentage','account_number'
	];

	public function company(){
		return $this->hasOne('App\company','id','company_id');
	}
}
