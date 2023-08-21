<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSupportTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_support_ticket', function (Blueprint $table) {
			$table->unsignedBigInteger('employee_id');
			$table->unsignedBigInteger('support_ticket_id');
			$table->primary(['employee_id','support_ticket_id']);

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('support_ticket_id')->references('id')->on('support_tickets')->onDelete('cascade');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_support_ticket');
    }
}
