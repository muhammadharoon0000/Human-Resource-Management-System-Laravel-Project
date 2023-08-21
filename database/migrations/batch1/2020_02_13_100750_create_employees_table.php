<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function (Blueprint $table) {
			$table->unsignedBigInteger('id');
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->string('email')->nullable();
			$table->string('contact_no',15);
			$table->date('date_of_birth');
			$table->string('gender');
			$table->unsignedBigInteger('office_shift_id')->nullable();
			$table->unsignedBigInteger('company_id')->nullable();
			$table->unsignedBigInteger('department_id')->nullable();
			$table->unsignedBigInteger('designation_id')->nullable();
			$table->unsignedBigInteger('location_id')->nullable();
			$table->Unsignedinteger('role_users_id')->nullable();
			$table->UnsignedBiginteger('status_id')->nullable();
			$table->date('joining_date')->nullable();
			$table->date('exit_date')->nullable();
			$table->string('marital_status')->nullable();
			$table->text('address')->nullable();
			$table->string('city',64)->nullable();
			$table->string('state',64)->nullable();
			$table->string('country',64)->nullable();
			$table->string('zip_code',24)->nullable();
			$table->string('cv',64)->nullable();
			$table->string('skype_id',64)->nullable();
			$table->string('fb_id',64)->nullable();
			$table->string('twitter_id',64)->nullable();
			$table->string('linkedIn_id',64)->nullable();
			$table->string('blogger_id',64)->nullable();
			$table->float('basic_salary')->default('0');
			$table->string('payslip_type');
			$table->tinyInteger('is_active')->nullable();


			$table->foreign('id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('office_shift_id')->references('id')->on('office_shifts')->onDelete('set null');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			$table->foreign('designation_id')->references('id')->on('designations')->onDelete('set null');
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
			$table->foreign('role_users_id')->references('id')->on('role_users')->onDelete('set null');
			$table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('employees');
	}
}
