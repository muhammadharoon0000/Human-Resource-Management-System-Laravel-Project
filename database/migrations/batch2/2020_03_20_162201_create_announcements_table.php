<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('announcements', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title');
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->text('summary')->nullable();
			$table->longText('description')->nullable();
			$table->UnsignedBiginteger('company_id')->nullable();
			$table->UnsignedBiginteger('department_id')->nullable();
			$table->string('added_by',40)->nullable();
			$table->tinyInteger('is_notify')->nullable();

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
		Schema::dropIfExists('announcements');
	}
}
