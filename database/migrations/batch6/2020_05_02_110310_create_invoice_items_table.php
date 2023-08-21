<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('invoice_id')->nullable();
			$table->unsignedBigInteger('project_id')->nullable();
			$table->string('item_name');
			$table->string('item_tax_type');
			$table->string('item_tax_rate');
			$table->bigInteger('item_qty')->default(0);
			$table->bigInteger('item_unit_price');
			$table->float('item_sub_total');
			$table->float('sub_total');
			$table->tinyInteger('discount_type')->nullable();
			$table->float('discount_figure');
			$table->float('total_tax');
			$table->float('total_discount');
			$table->float('grand_total');

			$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('invoice_items');
    }
}
