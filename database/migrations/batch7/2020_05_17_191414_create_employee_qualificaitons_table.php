<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeQualificaitonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_qualificaitons', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('employee_id');
			$table->unsignedBigInteger('education_level_id')->nullable();
			$table->string('institution_name');
			$table->date('from_year')->nullable();
			$table->date('to_year')->nullable();

			$table->unsignedBigInteger('language_skill_id')->nullable();
			$table->unsignedBigInteger('general_skill_id')->nullable();

			$table->mediumText('description')->nullable();

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('education_level_id')->references('id')->on('qualification_education_levels')->onDelete('set null');
			$table->foreign('language_skill_id')->references('id')->on('qualification_languages')->onDelete('set null');
			$table->foreign('general_skill_id')->references('id')->on('qualification_skills')->onDelete('set null');

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
        Schema::dropIfExists('employee_qualificaitons');
    }
}
