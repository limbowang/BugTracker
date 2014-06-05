<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create("bug", function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->string('name', 50);
            $table->string('details');
            $table->string('os', 30);
            $table->string('software');
            $table->enum('level', array('high', 'middle', 'low'));
            $table->string('tag')->nullable();
            $table->string('img', 60)->nullable();
            $table->integer('read_count')->default(0);
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
        Schema::dropIfExists('bug');
	}

}
