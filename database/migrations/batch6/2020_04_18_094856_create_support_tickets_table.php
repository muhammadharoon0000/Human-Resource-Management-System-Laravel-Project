<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->UnsignedBiginteger('company_id')->nullable();
			$table->UnsignedBiginteger('department_id')->nullable();
			$table->UnsignedBiginteger('employee_id')->nullable();
			$table->string('ticket_code',15)->unique();
			$table->string('subject');
			$table->string('ticket_priority',40);
			$table->mediumText('description')->nullable();
			$table->mediumText('ticket_remarks')->nullable();
			$table->string('ticket_status',40);
			$table->string('ticket_note')->nullable();
			$table->tinyInteger('is_notify')->nullable();
			$table->string('ticket_attachment')->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');

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
        Schema::dropIfExists('support_tickets');
    }
}
