<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->mediumText('description')->nullable();
			$table->date('start_date');
			$table->date('end_date');
			$table->string('training_cost');
			$table->string('status',30);
			$table->mediumText('remarks')->nullable();
			$table->unsignedBigInteger('company_id')->nullable();
			$table->unsignedBigInteger('trainer_id')->nullable();
			$table->unsignedBigInteger('training_type_id')->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('set null');
			$table->foreign('training_type_id')->references('id')->on('training_types')->onDelete('set null');

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
        Schema::dropIfExists('training_lists');
    }
}
