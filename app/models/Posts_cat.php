<?php

use Illuminate\Support\Facades\URL;

class Posts_cat extends Eloquent {

  public function post()
  {
    return $this->belongsTo('Post', 'post_id');
  }

  public function category()
  {
    return $this->belongsTo('Category', 'cat_id');
  }

};

?>
