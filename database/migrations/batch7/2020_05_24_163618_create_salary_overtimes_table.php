<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_overtimes', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('employee_id');
			$table->string('overtime_title');
			$table->string('no_of_days');
			$table->string('overtime_hours');
			$table->string('overtime_rate');
			$table->string('overtime_amount');

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

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
        Schema::dropIfExists('salary_overtimes');
    }
}
