<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('company_name');
			$table->string('company_type');
			$table->string('trading_name')->nullable();
			$table->string('registration_no')->nullable();
			$table->string('contact_no')->nullable();
			$table->string('email')->nullable();
			$table->string('website')->nullable();
			$table->string('tax_no')->nullable();
			$table->UnsignedBiginteger('location_id')->nullable();
			$table->string('company_logo')->nullable();
			$table->tinyInteger('is_active')->nullable();

			$table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');


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
        Schema::dropIfExists('companies');
    }
}
