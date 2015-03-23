<?php

use Illuminate\Support\Facades\URL;

class Post extends Eloquent {

  /**
   * All available for this post
   *
   */
  public $posts_text;

  /**
   * Deletes a blog post
   *
   * @return bool
   */
  public function delete()
  {
    // Delete the texts
    $this->hasMany('Posts_text', 'post_id')->delete();

    // Delete the blog post
    return parent::delete();
  }

  public function posts_cats()
  {
    return $this->belongsToMany('Category', 'posts_cats', 'post_id', 'cat_id');
  }

  public function categories()
  {
    return $this->belongsToMany('Category', 'posts_cats', 'post_id', 'cat_id');
  }

  /**
   * Return the Posts_text object from which text might be extract
   * based on current locale or default language if current locale
   * doesn't exist
   *
   * @return Posts_text
   */
  public function getPosts_text()
  {
    if ($this->posts_texts())
    {
      foreach ($this->posts_texts() as $text)
      {
        if ($text->lang == $this->lang)
          return $text;
      }
    }
    return False;
  }

  /**
   * If an lang is pass, returns a formatted post content entry,
   * this ensures that line breaks are returned.
   * Else, it will return an array with all available text
   *
   * @return string or array
   */
  public function content($lang)
  {
    $all = $this->posts_texts();
    if ($all)
    {
      if (!$lang)
        return $all;
      else
      {
        foreach ($all as $text)
        {
          if ($text->lang == $lang)
            return nl2br($text->content);
        }
      }
    }
    return Lang::get('message.no_text');
  }

  /**
   * Return all the lang available for this post
   *
   * @return array
   */
  public function availableLang()
  {
    $avail = array(
      'default' => $this->lang,
      'data'   => array()
    );
    foreach ($this->posts_texts() as $text)
      $avail['data'][$text->lang] = $text->lang;
    if (isset($avail['data'][App::getLocale()]))
      $avail['default'] = App::getLocale();
    return $avail;
  }

  /**
   * Return the title
   *
   * @return string
   */
  public function title()
  {
    if ($temp = $this->getPosts_text())
      return $temp->title;
    return "No title attach to post";
  }

  /**
   * Get the post's author.
   *
   * @return User
   */
  public function author()
  {
    return $this->belongsTo('User', 'user_id');
  }

  /**
   * Get the post's posts_texts
   *
   * @return array
   */
  public function posts_texts()
  {
    if (! $this->posts_texts)
      $this->posts_texts = $this->hasMany('Posts_text', 'post_id')->get();
    return $this->posts_texts;
  }

  /**
   * Get the date the post was created.
   *
   * @param \Carbon|null $date
   * @return string
   */
  public function date($date=null)
  {
    if(is_null($date)) {
      $date = $this->created_at;
    }

    return String::date($date);
  }

  /**
   * Get the URL to the post.
   *
   * @return string
   */
  public function url()
  {
    return Url::to($this->slug);
  }

  /**
   * Returns the date of the blog post creation,
   * on a good and more readable format :)
   *
   * @return string
   */
  public function created_at()
  {
    return $this->date($this->created_at);
  }

  /**
   * Returns the date of the blog post last update,
   * on a good and more readable format :)
   *
   * @return string
   */
  public function updated_at()
  {
    return $this->date($this->updated_at);
  }

}
