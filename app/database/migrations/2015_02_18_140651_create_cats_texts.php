<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatsTexts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('cats_texts', function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unsigned();
      $table->integer('cat_id')->unsigned();
      $table->string('lang');
      $table->string('long_name');
      $table->string('short_name');
      $table->timestamps();
    });

    Schema::table('cats_texts', function($table)
    {
      $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::drop('cats_texts');
	}

}
