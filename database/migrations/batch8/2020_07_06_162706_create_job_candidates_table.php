<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_candidates', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->unsignedBigInteger('job_id');
			$table->string('full_name');
			$table->string('email');
			$table->longText('cover_letter');
			$table->string('fb_id')->nullable();
			$table->string('linkedin_id')->nullable();
			$table->string('cv');
			$table->string('status');
			$table->string('remarks');

			$table->foreign('job_id')->references('id')->on('job_posts')->onDelete('no action');


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
        Schema::dropIfExists('job_candidates');
    }
}
