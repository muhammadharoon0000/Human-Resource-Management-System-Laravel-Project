<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('promotion_title',40);
			$table->mediumText('description')->nullable();
			$table->UnsignedBiginteger('company_id');
			$table->UnsignedBiginteger('employee_id');
			$table->date('promotion_date');

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('promotions');
    }
}
