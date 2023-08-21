<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statuses', function (Blueprint $table) {
			$table->string('status_title');
			$table->UnsignedBiginteger('employee_id')->nullable();

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statuses', function (Blueprint $table) {
			$table->dropForeign(['employee_id']);

			$table->dropColumn(['status_title','employee_id']);
		});
    }
}
