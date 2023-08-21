<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_files', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('task_id');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->string('file_title');
			$table->string('file_attachment');
			$table->mediumText('file_description')->nullable();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');


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
        Schema::dropIfExists('task_files');
    }
}
