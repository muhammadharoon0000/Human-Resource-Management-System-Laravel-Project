<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('designations', function (Blueprint $table) {
			$table->tinyInteger('is_active')->after('id')->nullable();
			$table->UnsignedBiginteger('department_id')->after('id')->nullable();
			$table->UnsignedBiginteger('company_id')->after('id')->nullable();
			$table->string('designation_name')->after('id');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('designations', function (Blueprint $table) {
			$table->dropForeign(['company_id']);
			$table->dropForeign(['department_id']);
			$table->dropColumn(['designation_name', 'company_id', 'department_id','is_active']);
		});
    }
}
