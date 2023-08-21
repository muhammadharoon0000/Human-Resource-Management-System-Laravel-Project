<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCompaniesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('companies', function (Blueprint $table) {
			$table->tinyInteger('is_active')->after('id')->nullable();
			$table->string('company_logo')->after('id')->nullable();
			$table->string('zip')->after('id')->nullable();
			$table->string('country')->after('id')->nullable();
			$table->string('state')->after('id')->nullable();
			$table->string('city')->after('id')->nullable();
			$table->string('address2')->after('id')->nullable();
			$table->string('address1')->after('id')->nullable();
			$table->string('tax_no')->after('id')->nullable();
			$table->string('website')->after('id')->nullable();
			$table->string('email')->after('id')->nullable();
			$table->string('contact_no')->after('id')->nullable();
			$table->string('registration_no')->after('id')->nullable();
			$table->string('trading_name')->after('id')->nullable();
			$table->string('company_type')->after('id');
			$table->string('company_name')->after('id');

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('companies', function (Blueprint $table) {
			$table->dropColumn(['company_name', 'company_type','trading_name', 'registration_no','contact_no','email','website','tax_no','address1','address2','city','state','country','zip','company_logo','is_active'
			]);

		});
	}
}
