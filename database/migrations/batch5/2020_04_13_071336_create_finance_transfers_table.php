<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id')->nullable();
			$table->unsignedBigInteger('from_account_id')->nullable();
			$table->unsignedBigInteger('to_account_id')->nullable();
			$table->string('amount',30);
			$table->string('reference');
			$table->mediumText('description')->nullable();
			$table->unsignedBigInteger('payment_method_id')->nullable();
			$table->date('date')->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('from_account_id')->references('id')->on('finance_bank_cashes')->onDelete('set null');
			$table->foreign('to_account_id')->references('id')->on('finance_bank_cashes')->onDelete('set null');
			$table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');


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
        Schema::dropIfExists('finance_transfers');
    }
}
