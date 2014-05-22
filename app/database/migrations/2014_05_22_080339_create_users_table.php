<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create("user", function($table) {
            $table->increments('id');
            $table->string('username', 15);
            $table->string('password', 25);
            $table->string('email', 80);
            $table->boolean('is_admin')->defalult(false);
            $table->string('avatar')->nullable();
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->dateTime('last_login_at')->nullable();
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
		//
        Schema::dropIfExists('user');
	}

}
