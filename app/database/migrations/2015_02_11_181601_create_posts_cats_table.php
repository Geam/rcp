<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    // Create the `Posts_cat` table
    Schema::create('posts_cats', function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unsigned();
      $table->integer('cat_id')->unsigned();
      $table->integer('post_id')->unsigned();
      $table->timestamps();
    });

	  Schema::table('posts_cats', function($table)
    {
      $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
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
    Schema::drop('posts_cats');
	}

}
