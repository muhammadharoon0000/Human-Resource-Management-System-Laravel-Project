<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->mediumText('description')->nullable();
			$table->UnsignedBiginteger('company_id');
			$table->UnsignedBiginteger('terminated_employee');
			$table->UnsignedBiginteger('termination_type')->nullable();
			$table->date('termination_date');
			$table->date('notice_date');
			$table->string('status',40);

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('terminated_employee')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('termination_type')->references('id')->on('termination_types')->onDelete('set null');

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
        Schema::dropIfExists('terminations');
    }
}
