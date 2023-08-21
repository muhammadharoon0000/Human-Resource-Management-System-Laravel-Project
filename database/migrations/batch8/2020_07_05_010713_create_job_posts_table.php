<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id');
			$table->unsignedBigInteger('job_category_id');
			$table->string('job_title');
			$table->string('job_type');
			$table->integer('no_of_vacancy');
			$table->string('job_url');
			$table->string('gender',30);
			$table->string('min_experience',20);
			$table->mediumText('short_description');
			$table->longText('long_description');
			$table->date('closing_date');
			$table->tinyInteger('status');
			$table->tinyInteger('is_featured');


			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('job_category_id')->references('id')->on('job_categories')->onDelete('cascade');

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
        Schema::dropIfExists('job_posts');
    }
}
