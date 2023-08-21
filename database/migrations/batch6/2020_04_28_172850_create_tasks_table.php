<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('task_name');
			$table->unsignedBigInteger('project_id');
			$table->unsignedBigInteger('company_id')->nullable();
			$table->date('start_date');
			$table->date('end_date');
			$table->string('task_hour',40);
			$table->mediumText('description')->nullable();
			$table->string('task_status',40)->default('not started');
			$table->mediumText('task_note')->nullable();
			$table->string('task_progress')->nullable();
			$table->tinyInteger('is_notify')->nullable();
			$table->unsignedBigInteger('added_by')->nullable();

			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
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
        Schema::dropIfExists('tasks');
    }
}
