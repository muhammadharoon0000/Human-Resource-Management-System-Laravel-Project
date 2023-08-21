<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEmployeesTable extends Migration
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
			$table->string('email')->nullable();
			$table->string('contact_no',15);
			$table->date('date_of_birth');
			$table->string('gender');
			$table->unsignedBigInteger('status_id')->nullable();
			$table->unsignedBigInteger('office_shift_id')->nullable();
			$table->unsignedBigInteger('company_id')->nullable();
			$table->unsignedBigInteger('department_id')->nullable();
			$table->unsignedBigInteger('designation_id')->nullable();
			$table->unsignedBigInteger('location_id')->nullable();
			$table->Unsignedinteger('role_users_id')->nullable();
			$table->UnsignedBiginteger('permission_role_id')->nullable();
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
			$table->unsignedBigInteger('attendance_id')->nullable();
			$table->unsignedBigInteger('performance_id')->nullable();
			$table->unsignedBigInteger('resignation_id')->nullable();
			$table->unsignedBigInteger('promotion_id')->nullable();
			$table->unsignedBigInteger('complaint_id')->nullable();
			$table->unsignedBigInteger('warning_id')->nullable();


			$table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
			$table->foreign('office_shift_id')->references('id')->on('office_shifts')->onDelete('set null');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('set null');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			$table->foreign('designation_id')->references('id')->on('designations')->onDelete('set null');
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
			$table->foreign('role_users_id')->references('id')->on('role_users')->onDelete('set null');
			$table->foreign('permission_role_id')->references('id')->on('roles')->onDelete('set null');
			$table->foreign('performance_id')->references('id')->on('performances')->onDelete('set null');
			$table->foreign('resignation_id')->references('id')->on('resignations')->onDelete('set null');
			$table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('set null');
			$table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('set null');
			$table->foreign('warning_id')->references('id')->on('warnings')->onDelete('set null');

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

			$table->dropForeign(['company_id']);
			$table->dropForeign(['department_id']);
			$table->dropForeign(['employee_id']);
			$table->dropForeign(['status_id']);
			$table->dropForeign(['office_shift_id']);
			$table->dropForeign(['attendance_id']);
			$table->dropForeign(['designation_id']);
			$table->dropForeign(['location_id']);
			$table->dropForeign(['salary_id']);
			$table->dropForeign(['role_users_id']);
			$table->dropForeign(['permission_role_id']);
			$table->dropForeign(['performance_id']);
			$table->dropForeign(['award_id']);
			$table->dropForeign(['resignation_id']);
			$table->dropForeign(['complain_id']);
			$table->dropForeign(['promotion_id']);
			$table->dropForeign(['warning_id']);

			$table->dropColumn(['first_name','last_name','email','contact_no','date_of_birth','gender','employee_id','status_id','office_shift_id','salary_id','location_id','designation_id', 'company_id', 'department_id','is_active',
				'role_users_id','joining_date','exit_date','marital_status','address','city','state','country','zip_code','cv','skype_id','fb_id',
				'twitter_id','linkedIn_id','blogger_id','attendance_id','performance_id','award_id',
				'promotion_id','complain_id','warning_id']);
		});
    }
}
