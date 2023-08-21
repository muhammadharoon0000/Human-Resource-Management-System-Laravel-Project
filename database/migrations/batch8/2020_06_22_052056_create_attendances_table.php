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
			$table->string('clock_in');
			$table->ipAddress('clock_in_ip');
			$table->string('clock_out');
			$table->ipAddress('clock_out_ip');
			$table->tinyInteger('clock_in_out');
			$table->string('time_late')->default('00:00');
			$table->string('early_leaving')->default('00:00');
			$table->string('overtime')->default('00:00');
			$table->string('total_work')->default('00:00');
			$table->string('total_rest')->default('00:00');
			$table->string('attendance_status')->default('present');

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

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
