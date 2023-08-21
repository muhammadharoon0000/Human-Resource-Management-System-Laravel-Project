<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('designation_name');
			$table->UnsignedBiginteger('company_id')->nullable();
			$table->UnsignedBiginteger('department_id')->nullable();
			$table->tinyInteger('is_active')->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');

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
        Schema::dropIfExists('designations');
    }
}
