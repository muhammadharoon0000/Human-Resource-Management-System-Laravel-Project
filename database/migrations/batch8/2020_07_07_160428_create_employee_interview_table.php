<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_interview', function (Blueprint $table) {
			$table->unsignedBigInteger('interview_id');
			$table->unsignedBigInteger('employee_id');
			$table->primary(['interview_id','employee_id']);

			$table->foreign('interview_id')->references('id')->on('job_interviews')->onDelete('cascade');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('no action');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_interview');
    }
}
