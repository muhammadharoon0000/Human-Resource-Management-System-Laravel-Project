<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOfficeShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('office_shifts', function (Blueprint $table) {
			$table->string('sunday_in')->after('id')->nullable();
			$table->string('sunday_out')->after('id')->nullable();
			$table->string('saturday_in')->after('id')->nullable();
			$table->string('saturday_out')->after('id')->nullable();
			$table->string('friday_in')->after('id')->nullable();
			$table->string('friday_out')->after('id')->nullable();
			$table->string('thursday_in')->after('id')->nullable();
			$table->string('thursday_out')->after('id')->nullable();
			$table->string('wednesday_in')->after('id')->nullable();
			$table->string('wednesday_out')->after('id')->nullable();
			$table->string('tuesday_in')->after('id')->nullable();
			$table->string('tuesday_out')->after('id')->nullable();
			$table->string('monday_in')->after('id')->nullable();
			$table->string('monday_out')->after('id')->nullable();
			$table->string('default_shift')->after('id')->nullable();
			$table->UnsignedBiginteger('company_id')->after('id');
			$table->string('shift_name')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('office_shifts', function (Blueprint $table) {
			$table->dropColumn(['shift_name','company_id', 'default_shift','monday_in','monday_out','tuesday_in','tuesday_out','wednesday_in','wednesday_out','thursday_in','thursday_out','friday_in','friday_out','saturday_in','saturday_out','sunday_in','sunday_out']);
			$table->dropForeign(['company_id']);

        });
    }
}
