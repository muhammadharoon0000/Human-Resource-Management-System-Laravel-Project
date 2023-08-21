<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('username',64);
            $table->string('email',64)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
			$table->string('profile_photo')->nullable();
			$table->string('profile_bg')->nullable();;
			$table->Unsignedinteger('role_users_id');
			$table->tinyInteger('is_active')->nullable();
			$table->string('contact_no',15);
			$table->string('last_login_ip',32)->nullable();
			$table->timestampTz('last_login_date','2')->nullable();
            $table->rememberToken();
            $table->timestamps();
			$table->softDeletes();
            $table->foreign('role_users_id')->references('id')->on('role_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
