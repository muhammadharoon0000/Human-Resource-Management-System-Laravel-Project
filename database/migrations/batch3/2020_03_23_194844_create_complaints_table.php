<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('complaint_title',40);
			$table->mediumText('description')->nullable();
			$table->UnsignedBiginteger('company_id');
			$table->UnsignedBiginteger('complaint_from');
			$table->UnsignedBiginteger('complaint_against');
			$table->date('complaint_date');
			$table->string('status',40);

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('complaint_from')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('complaint_against')->references('id')->on('employees')->onDelete('cascade');

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
        Schema::dropIfExists('complaints');
    }
}
