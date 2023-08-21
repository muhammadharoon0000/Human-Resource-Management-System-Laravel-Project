<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('employee_id');
			$table->unsignedBigInteger('document_type_id')->nullable();
			$table->string('document_title');
			$table->mediumText('description')->nullable();
			$table->string('document_file')->nullable();
			$table->date('expiry_date');
			$table->tinyInteger('is_notify')->nullable();

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
        Schema::dropIfExists('employee_documents');
    }
}
