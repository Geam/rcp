<?php

use Illuminate\Support\Facades\URL;

class Category extends Eloquent {

  /**
   * Table name
   * @var table
   */
  protected $table = 'categories';

  public function posts_cats()
  {
    return $this->hasMany('Posts_cat', 'cat_id');
  }

  public function cats_text()
  {
    $temp = $this->hasMany('Cats_text', 'cat_id')->where('lang', '=', App::getLocale());
    $temp = NULL;
    if (!$temp)
      $temp = $this->hasMany('Cats_text', 'cat_id')->where('lang', '=', 'en');
    return $temp->first();
  }

  public function getChildsId()
  {
    return $this->hasMany('Category', 'parent_id')->select('id')->get();
  }

  public function getParentName()
  {
    $tree = Category::getTree();
    return $this->_getParentName($tree, $this->id);
    return $this->cats_text()->short_name;
  }

  static public function getTree()
  {
    $tree = array();
    $tree[0] = array(
      'childs' => array()
    );

    $all = Category::all();
    foreach ($all as $cat)
    {
      $temp = $cat->cats_text();
      $tree[$cat->id] = array(
        'parent_id'   =>  $cat->parent_id,
        'short_name'  =>  $temp->short_name,
        'long_name'   =>  $temp->long_name,
        'childs'      =>  $cat->getChildsId(),
      );
    }

    return $tree;
  }

  private function _getParentName($tree, $id)
  {
    if ($tree[$id]['parent_id'])
      return $this->_getParentName($tree, $tree[$id]['parent_id']) . " | " . $tree[$id]['short_name'];
    else
      return $tree[$id]['short_name'];
  }

};

?>
