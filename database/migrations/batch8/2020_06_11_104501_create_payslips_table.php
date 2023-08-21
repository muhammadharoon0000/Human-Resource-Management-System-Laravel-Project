<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('payslip_key');
            $table->unsignedBigInteger('employee_id');
            $table->string('payment_type');
            $table->float('basic_salary');
			$table->float('net_salary');
            $table->text('allowances');
			$table->text('commissions');
			$table->text('loans');
			$table->text('deductions');
			$table->text('overtimes');
			$table->text('other_payments');
			$table->integer('hours_worked');
			$table->tinyInteger('status');
			$table->string('month_year','15');

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

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
        Schema::dropIfExists('payslips');
    }
}
