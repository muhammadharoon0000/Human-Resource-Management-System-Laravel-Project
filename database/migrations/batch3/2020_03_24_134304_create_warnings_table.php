<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warnings', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('subject');
			$table->mediumText('description')->nullable();
			$table->UnsignedBiginteger('company_id');
			$table->UnsignedBiginteger('warning_to');
			$table->UnsignedBiginteger('warning_type')->nullable();
			$table->date('warning_date');
			$table->string('status',40);

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('warning_to')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('warning_type')->references('id')->on('warnings_type')->onDelete('set null');

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
        Schema::dropIfExists('warnings');
    }
}
