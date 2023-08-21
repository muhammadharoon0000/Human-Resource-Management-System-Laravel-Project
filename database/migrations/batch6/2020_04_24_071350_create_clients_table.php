<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name');
			$table->string('email');
			$table->string('contact_no',15);
			$table->string('username',64);
			$table->string('profile')->nullable();
			$table->string('company_name');
			$table->string('gender',40);
			$table->string('website',40)->nullable();
			$table->mediumText('address1')->nullable();
			$table->mediumText('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->tinyInteger('country')->nullable();
			$table->tinyInteger('is_active')->nullable();

			$table->foreign('id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('country')->references('id')->on('countries')->onDelete('cascade');

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
        Schema::dropIfExists('clients');
    }
}
