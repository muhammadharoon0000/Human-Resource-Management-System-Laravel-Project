<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('client_id')->nullable();
			$table->unsignedBigInteger('company_id')->nullable();
			$table->date('start_date');
			$table->date('end_date');
			$table->string('project_priority',40);
			$table->mediumText('description')->nullable();
			$table->mediumText('summary')->nullable();
			$table->string('project_status',40)->default('not started');
			$table->longText('project_note')->nullable();
			$table->string('project_progress')->nullable();
			$table->tinyInteger('is_notify')->nullable();
			$table->unsignedBigInteger('added_by')->nullable();

			$table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
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
        Schema::dropIfExists('projects');
    }
}
