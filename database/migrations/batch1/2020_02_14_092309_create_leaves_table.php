<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->UnsignedBiginteger('leave_type_id')->nullable();
			$table->UnsignedBiginteger('company_id');
			$table->UnsignedBiginteger('department_id');
			$table->UnsignedBiginteger('employee_id')->nullable();
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('total_days');
			$table->mediumText('leave_reason')->nullable();
			$table->string('remarks')->nullable();
			$table->string('status',40);
			$table->tinyInteger('is_half')->default(0)->nullable();
			$table->tinyInteger('is_notify')->default(0)->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
			$table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('set null');
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
        Schema::dropIfExists('leaves');
    }
}
