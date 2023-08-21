<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('employee_id');
			$table->string('relation',50);
			$table->tinyInteger('is_primary')->nullable()->default(0);
			$table->tinyInteger('is_dependent')->nullable()->default(0);
			$table->string('contact_name');
			$table->string('work_phone')->nullable();
			$table->string('work_phone_ext')->nullable();
			$table->string('personal_phone')->nullable();
			$table->string('home_phone')->nullable();
			$table->string('work_email')->nullable();
			$table->string('personal_email')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->integer('country_id');

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
        Schema::dropIfExists('employee_contacts');
    }
}
