<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FinanceExpense extends Model
{
	protected $fillable = [
		'id','company_id','account_id','amount','category_id','description','payment_method_id','payee_id',
		'expense_reference','expense_date','expense_file'
	];

	public function company(){
		return $this->hasOne('App\company','id','company_id');
	}

	public function Account(){
		return $this->hasOne('App\FinanceBankCash','id','account_id');
	}

	public function PaymentMethod(){
		return $this->hasOne('App\PaymentMethod','id','payment_method_id');
	}

	public function Payee(){
		return $this->hasOne('App\FinancePayees','id','payee_id');
	}

	public function Category(){
		return $this->hasOne('App\ExpenseType','id','category_id');
	}

	public function setExpenseDateAttribute($value)
	{
		$this->attributes['expense_date'] = Carbon::createFromFormat(env('Date_Format'), $value)->format('Y-m-d');
	}

	public function getExpenseDateAttribute($value)
	{
		return Carbon::parse($value)->format(env('Date_Format'));
	}



}

