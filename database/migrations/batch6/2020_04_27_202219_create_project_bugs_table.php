<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_bugs', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('project_id');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->mediumText('title');
			$table->string('bug_attachment')->nullable();
			$table->string('status')->default('pending');

			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

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
        Schema::dropIfExists('project_bugs');
    }
}
