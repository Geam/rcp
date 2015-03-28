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

  public function cats_text($lang)
  {
    $temp = $this->hasMany('Cats_text', 'cat_id')->where('lang', '=', $lang)->first();
    if (! $temp)
      $temp = $this->hasMany('Cats_text', 'cat_id')->where('lang', '=', 'en')->first();
    return $temp;
  }

  public function getChildsId()
  {
    return $this->hasMany('Category', 'parent_id')->select('id')->get();
  }

  public function getParentName()
  {
    $tree = Category::getTree();
    return $this->_getParentName($tree, $this->id);
  }

  private function _getParentName($tree, $id)
  {
    if ($tree[$id]['parent_id'])
      return $this->_getParentName($tree, $tree[$id]['parent_id']) . " | " . $tree[$id]['short_name'];
    else
      return $tree[$id]['short_name'];
  }

  static public function jsTree($lang)
  {
    $all = Category::select(
      'categories.id',
      'categories.parent_id as parent'
    )->get();
    for ($i = 0; $i < count($all); $i++) {
      $temp = $all[$i]->cats_text($lang);
      $all[$i]['text'] = $temp->short_name;
      $all[$i]['long'] = $temp->long_name;
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
