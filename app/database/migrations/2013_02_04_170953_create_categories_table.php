<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function(Blueprint $table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unsigned();
      $table->integer('parent_id');
      $table->string('long_name');
      $table->string('short_name');
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
    Schema::drop('categories');
  }

}
