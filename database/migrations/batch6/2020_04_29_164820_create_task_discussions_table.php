<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_discussions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('task_id');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->mediumText('task_discussion');

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
        Schema::dropIfExists('task_discussions');
    }
}
