<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDepartmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('departments', function (Blueprint $table) {
			$table->tinyInteger('is_active')->after('id')->nullable();
			$table->UnsignedBiginteger('employee_id')->after('id')->nullable();
			$table->UnsignedBiginteger('location_id')->after('id')->nullable();
			$table->UnsignedBiginteger('company_id')->after('id')->nullable();
			$table->string('department_name')->after('id');

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');;



		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('departments', function (Blueprint $table) {
			$table->dropColumn(['department_name', 'company_id', 'location_id','employee_id','is_active']);
			$table->dropForeign(['company_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['employee_id']);


		});
	}
}
