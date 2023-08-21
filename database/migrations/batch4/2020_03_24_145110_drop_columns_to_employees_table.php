<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
			$table->dropColumn(['date_of_birth', 'employee_id', 'office_shift_id','status_id','department_id','designation_id','location_id','salary_id','marital_status','address','city'
				,'state','country','zip_code','cv','skype_id','fb_id','twitter_id'
				,'linkedIn_id','blogger_id','leave_id','performance_id','award_id']);
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
