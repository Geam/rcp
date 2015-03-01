<?php

class PostsTableSeeder extends Seeder {

  public function run()
  {
    DB::table('posts')->delete();
    DB::table('posts_texts')->delete();
    DB::table('posts_cats')->delete();

    DB::table('posts')->insert( array(
      array(
        'user_id'           => User::first()->id,
        'importance'        => 3,
        'slug'              => 'Beresnev c Russia',
        'nature'            => 'judgement',
        'affair_id'         => '37975/02',
        'lang'              => 'en',
        'state'             => 'ru',
        'meta_title'        => 'Beresnev c Russia',
        'meta_description'  => 'Beresnev c Russia',
        'meta_keywords'     => 'Beresnev c Russia',
        'p_date'            => '2013-12-24',
        'created_at'        => new DateTime,
        'updated_at'        => new DateTime,
      )
    ));

    DB::table('posts_texts')->insert( array(
      array(
        'post_id'           => Post::first()->id,
        'lang'              => 'en',
        'title'             => 'Beresnev c Russia',
        'content'           => 'blabla to change',
      )
    ));

    DB::table('posts_cats')->insert( array(
      array(
        'cat_id'  => 2,
        'post_id' => Post::first()->id,
      ),
      array(
        'cat_id'  => 21,
        'post_id' => Post::first()->id,
      ),
    ));
  }

}
