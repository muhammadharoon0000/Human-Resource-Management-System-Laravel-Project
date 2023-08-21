<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_employers', function (Blueprint $table) {
			$table->unsignedBigInteger('id')->autoIncrement();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('contact_no',15);
			$table->string('logo')->nullable();
			$table->string('company_name');

			$table->timestamps();

			$table->foreign('id')->references('id')->on('users')->onDelete('cascade');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_employers');
    }
}
