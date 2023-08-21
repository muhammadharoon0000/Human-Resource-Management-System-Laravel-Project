<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsasToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->date('date_of_birth');
			$table->string('gender');
			$table->integer('employee_id')->nullable();
			$table->string('status',20);
			$table->unsignedBigInteger('office_shift_id');
			$table->unsignedBigInteger('company_id')->nullable();
			$table->unsignedBigInteger('department_id')->nullable();
			$table->unsignedBigInteger('designation_id')->nullable();
			$table->unsignedBigInteger('location_id')->nullable();
			$table->Unsignedinteger('role_users_id');
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
			$table->tinyInteger('is_active')->nullable();
			$table->unsignedBigInteger('leave_id')->nullable();
			$table->unsignedBigInteger('performance_id')->nullable();
			$table->unsignedBigInteger('transfer_id')->nullable();
			$table->unsignedBigInteger('resignation_id')->nullable();



			$table->foreign('office_shift_id')->references('id')->on('office_shifts')->onDelete('set null');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			$table->foreign('designation_id')->references('id')->on('designations')->onDelete('set null');
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
			$table->foreign('role_users_id')->references('id')->on('role_users')->onDelete('set null');
			$table->foreign('leave_id')->references('id')->on('leaves')->onDelete('set null');
			$table->foreign('performance_id')->references('id')->on('performances')->onDelete('set null');
			$table->foreign('award_id')->references('id')->on('awards')->onDelete('set null');
			$table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('set null');
			$table->foreign('resignation_id')->references('id')->on('resignations')->onDelete('set null');;


		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
