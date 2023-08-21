<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id')->nullable();
			$table->unsignedBigInteger('document_type_id')->nullable();
			$table->unsignedBigInteger('added_by')->nullable();
			$table->string('document_title');
			$table->string('identification_number');
			$table->mediumText('description')->nullable();
			$table->string('document_file')->nullable();
			$table->date('expiry_date');
			$table->tinyInteger('is_notify')->nullable();

			$table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
			$table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('set null');
			$table->foreign('added_by')->references('id')->on('users')->onDelete('set null');

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
        Schema::dropIfExists('official_documents');
    }
}
