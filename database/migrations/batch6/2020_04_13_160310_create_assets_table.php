<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('asset_name',50);
			$table->unsignedBigInteger('company_id');
			$table->unsignedBigInteger('employee_id')->nullable();
			$table->string('asset_code',80);
			$table->unsignedBigInteger('assets_category_id');
			$table->mediumText('Asset_note')->nullable();
			$table->string('manufacturer');
			$table->string('serial_number');
			$table->string('invoice_number');
			$table->string('asset_image')->nullable();
			$table->date('purchase_date');
			$table->date('warranty_date');
			$table->string('status');

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
			$table->foreign('assets_category_id')->references('id')->on('asset_categories')->onDelete('cascade');

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
        Schema::dropIfExists('assets');
    }
}
