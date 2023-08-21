<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->mediumText('award_information')->nullable();
			$table->date('award_date');
			$table->string('gift',40)->nullable();
			$table->string('cash',40)->nullable();
			$table->UnsignedBiginteger('company_id')->nullable();
			$table->UnsignedBiginteger('department_id')->nullable();
			$table->UnsignedBiginteger('employee_id');
			$table->UnsignedBiginteger('award_type_id')->nullable();
			$table->string('award_photo')->nullable();
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('award_type_id')->references('id')->on('award_types')->onDelete('set null');

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
        Schema::dropIfExists('awards');
    }
}
