<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('shift_name');
			$table->string('default_shift')->nullable();
			$table->UnsignedBiginteger('company_id');

			$table->string('sunday_in')->nullable();
			$table->string('sunday_out')->nullable();
			$table->string('saturday_in')->nullable();
			$table->string('saturday_out')->nullable();
			$table->string('friday_in')->nullable();
			$table->string('friday_out')->nullable();
			$table->string('thursday_in')->nullable();
			$table->string('thursday_out')->nullable();
			$table->string('wednesday_in')->nullable();
			$table->string('wednesday_out')->nullable();
			$table->string('tuesday_in')->nullable();
			$table->string('tuesday_out')->nullable();
			$table->string('monday_in')->nullable();
			$table->string('monday_out')->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

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
        Schema::dropIfExists('office_shifts');
    }
}
