<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    // Create the `Posts` table
    Schema::create('posts', function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unsigned();
      $table->integer('user_id')->unsigned()->index();
      $table->integer('importance')->unsigned();
      $table->string('slug');
      $table->string('nature');
      $table->string('affair_id');
      $table->string('lang');
      $table->string('state');
      $table->string('meta_title');
      $table->string('meta_description');
      $table->string('meta_keywords');
      $table->date('p_date');
      $table->timestamps();
    });

    // Delayed for foreign
    Schema::table('posts', function($table)
    {
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    // Delete the `Posts` table
    Schema::drop('posts');
  }

}
