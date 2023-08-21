<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('job_id');
			$table->unsignedBigInteger('added_by')->nullable();
			$table->string('interview_place');
			$table->date('interview_date');
			$table->time('interview_time');
			$table->longText('description');

			$table->foreign('job_id')->references('id')->on('job_posts')->onDelete('cascade');
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
        Schema::dropIfExists('job_interviews');
    }
}
