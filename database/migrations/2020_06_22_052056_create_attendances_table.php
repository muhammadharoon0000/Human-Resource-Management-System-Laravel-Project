<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->date('attendance_date');
			$table->timestamp('clock_in');
			$table->ipAddress('clock_in_ip');
			$table->timestamp('clock_out');
			$table->ipAddress('clock_out_ip');
			$table->tinyInteger('clock_in_out');
			$table->string('time_late');
			$table->string('early_leaving');
			$table->string('overtime');
			$table->string('total_work');
			$table->string('total_rest');
			$table->string('attendance_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
