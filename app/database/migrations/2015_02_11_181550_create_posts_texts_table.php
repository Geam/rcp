<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTextsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    // Create the `Posts_text` table
    Schema::create('posts_texts', function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unsigned();
      $table->integer('post_id')->unsigned();
      $table->string('lang');
      $table->string('title');
      $table->text('content');
      $table->timestamps();
    });

    Schema::table('posts_texts', function($table)
    {
      $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
    });

}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::drop('posts_texts');
	}

}
