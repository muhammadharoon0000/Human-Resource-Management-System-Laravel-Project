<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_managers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('department_id')->nullable();
			$table->unsignedBigInteger('added_by')->nullable();
			$table->string('file_name');
			$table->string('file_size')->nullable();
			$table->string('file_extension')->nullable();
			$table->string('external_link')->nullable();

			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			$table->foreign('added_by')->references('id')->on('users')->onDelete('set null');

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
        Schema::dropIfExists('file_managers');
    }
}
