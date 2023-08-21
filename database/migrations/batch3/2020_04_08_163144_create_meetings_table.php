<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id');
			$table->string('meeting_title');
			$table->mediumText('meeting_note');
			$table->date('meeting_date');
			$table->string('meeting_time');
			$table->string('status',30);
			$table->tinyInteger('is_notify')->default(0)->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

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
        Schema::dropIfExists('meetings');
    }
}
