<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('employee_id');
			$table->string('loan_title');
			$table->string('loan_amount');
			$table->string('loan_type');
			$table->string('loan_time');
			$table->string('amount_remaining');
			$table->string('time_remaining');
			$table->string('monthly_payable','50');
			$table->mediumText('reason')->nullable();


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
        Schema::dropIfExists('salary_loans');
    }
}
