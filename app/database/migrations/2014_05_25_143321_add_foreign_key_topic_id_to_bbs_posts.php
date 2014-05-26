<?php

use Illuminate\Database\Migrations\Migration;

class AddForeignKeyTopicIdToBbsPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('bbs_post', function($table) {
            $table->integer('topic_id')->unsigned();
            $table->foreign('topic_id')->references('id')->on('bbs_topic');
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
        Schema::table('bbs_post', function($table) {
            $table->dropColumn('topic_id');
        });
	}

}
