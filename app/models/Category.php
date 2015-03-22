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

  private function _getParentName($tree, $id)
  {
    if ($tree[$id]['parent_id'])
      return $this->_getParentName($tree, $tree[$id]['parent_id']) . " | " . $tree[$id]['short_name'];
    else
      return $tree[$id]['short_name'];
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
        'id'          =>  $cat->id,
        'parent_id'   =>  $cat->parent_id,
        'short_name'  =>  $temp->short_name,
        'long_name'   =>  $temp->long_name,
      );
      if (! isset($tree[$cat->id]['childs']))
        $tree[$cat->id]['childs'] = array();
      if (! isset($tree[$cat->parent_id]))
        $tree[$cat->parent_id] = array('childs' => array());
      $tree[$cat->parent_id]['childs'][] = $cat->id;
    }
    return $tree;
  }

  static public function jsTree($lang)
  {
    $all = Category::join('cats_texts', 'categories.id', '=', 'cats_texts.cat_id')
      ->select(
        'categories.id',
        'categories.parent_id as parent',
        'cats_texts.short_name as text',
        'cats_texts.long_name as long'
      )
      ->where('cats_texts.lang', '=', $lang)->get();
    for ($i = 0; $i < count($all); $i++) {
      if ($all[$i]['parent'] == '0')
        $all[$i]['parent'] = '#';
    }
    return $all;
  }

  static public function getOptionsFromParent($tree, $id)
  {
    $ret = array();
    foreach ($tree as $leaf)
    {
      if (isset($leaf['parent_id']) && $leaf['parent_id'] == $id)
        $ret[] = $leaf;
    }
    return $ret;
  }

};

?>
