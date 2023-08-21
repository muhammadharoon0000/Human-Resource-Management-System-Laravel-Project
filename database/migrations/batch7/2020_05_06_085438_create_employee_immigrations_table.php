<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeImmigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_immigrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('document_type_id')->nullable();
            $table->string('document_number');
            $table->string('document_file')->nullable();
            $table->date('issue_date');
			$table->date('expiry_date');
			$table->date('eligible_review_date');
			$table->integer('country_id');

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('set null');

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
        Schema::dropIfExists('employee_immigrations');
    }
}
