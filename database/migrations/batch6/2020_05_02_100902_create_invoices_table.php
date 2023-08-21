<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('invoice_number');
			$table->unsignedBigInteger('client_id')->nullable();
			$table->unsignedBigInteger('project_id')->nullable();
			$table->date('invoice_date');
			$table->date('invoice_due_date');
			$table->float('sub_total');
			$table->tinyInteger('discount_type')->nullable();
			$table->float('discount_figure');
			$table->float('total_tax');
			$table->float('total_discount');
			$table->float('grand_total');
			$table->mediumText('invoice_note')->nullable();
			$table->tinyInteger('status')->nullable();

			$table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');

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
        Schema::dropIfExists('invoices');
    }
}
