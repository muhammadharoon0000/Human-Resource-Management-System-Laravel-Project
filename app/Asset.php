<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
	protected $fillable = [
		'company_id','employee_id','asset_name','assets_category_id','Asset_note','manufacturer','asset_code',
		'invoice_number','purchase_date','serial_number','asset_image','warranty_date','status'
	];

	public function company(){
		return $this->hasOne('App\company','id','company_id');
	}

	public function employee(){
		return $this->hasOne('App\Employee','id','employee_id');
	}


	public function Category(){
		return $this->hasOne('App\AssetCategory','id','assets_category_id');
	}

	public function setPurchaseDateAttribute($value)
	{
		$this->attributes['purchase_date'] = Carbon::createFromFormat(env('Date_Format'), $value)->format('Y-m-d');
	}

	public function getPurchaseDateAttribute($value)
	{

		return Carbon::parse($value)->format(env('Date_Format'));
	}

	public function setWarrantyDateAttribute($value)
	{
		$this->attributes['warranty_date'] = Carbon::createFromFormat(env('Date_Format'), $value)->format('Y-m-d');
	}

	public function getWarrantyDateAttribute($value)
	{
		return Carbon::parse($value)->format(env('Date_Format'));
	}
}
