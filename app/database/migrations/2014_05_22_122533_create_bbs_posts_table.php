<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBbsPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create("bbs_post", function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->integer('topic_id')->unsigned();
            $table->foreign('topic_id')->references('id')->on('bbs_topic');
            $table->string('title', 50);
            $table->string('content');
            $table->integer('read_count')->default(0);
            $table->boolean('is_top')->default(false);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('bbs_post');
	}

}
