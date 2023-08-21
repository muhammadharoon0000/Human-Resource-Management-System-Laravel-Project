<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id');
			$table->unsignedBigInteger('department_id');
			$table->string('event_title');
			$table->mediumText('event_note');
			$table->date('event_date');
			$table->string('event_time');
			$table->string('status',30);
			$table->tinyInteger('is_notify')->default(0)->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

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
        Schema::dropIfExists('events');
    }
}
