<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->string('customer_experience');
            $table->string('marketing')->nullable();
            $table->string('administration')->nullable();
            $table->string('professionalism')->nullable();
            $table->string('integrity')->nullable();
            $table->string('attendance')->nullable();
            $table->text('remarks')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();

            // $table->foreign('company_id')->references('id')->on('companies');
            // $table->foreign('employee_id')->references('id')->on('employees');
            // $table->foreign('department_id')->references('id')->on('departments');
            // $table->foreign('designation_id')->references('id')->on('designations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appraisals');
    }
}
