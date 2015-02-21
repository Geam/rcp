<?php

use Illuminate\Support\Facades\URL;

class Posts_text extends Eloquent {

  public function post()
  {
    return $this->belongsTo('Post', 'id');
  }

};

?>
