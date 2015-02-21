<?php

use Illuminate\Support\Facades\URL;

class Cats_text extends Eloquent {

  public function category()
  {
    return $this->belongsTo('Category', 'id');
  }
};

?>
