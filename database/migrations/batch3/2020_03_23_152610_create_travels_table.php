<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->mediumText('description')->nullable();
			$table->UnsignedBiginteger('company_id');
			$table->UnsignedBiginteger('employee_id');
			$table->UnsignedBiginteger('travel_type')->nullable();
			$table->date('start_date');
			$table->date('end_date');
			$table->string('purpose_of_visit')->nullable();
			$table->string('place_of_visit')->nullable();
			$table->string('expected_budget',20)->nullable();
			$table->string('actual_budget',20)->nullable();
			$table->string('travel_mode',20);
			$table->string('status',30);

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('travel_type')->references('id')->on('travel_types')->onDelete('set null');


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
        Schema::dropIfExists('travels');
    }
}
