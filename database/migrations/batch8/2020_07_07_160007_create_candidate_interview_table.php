<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_interview', function (Blueprint $table) {
			$table->unsignedBigInteger('interview_id');
			$table->unsignedBigInteger('candidate_id');
			$table->primary(['interview_id','candidate_id']);

			$table->foreign('interview_id')->references('id')->on('job_interviews')->onDelete('cascade');
			$table->foreign('candidate_id')->references('id')->on('job_candidates')->onDelete(' no action');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_interview');
    }
}
