<?php

class AdminCategoriesController extends AdminController
{

  /**
   * Category Model
   * @var Category
   */
  protected $category;

  /**
   * Inject the models
   * @param Category $category
   */
  public function __construct(Category $category)
  {
    parent::__construct();
    $this->category = $category;
  }

  /**
   * Main page for the categories. It is useless but I keep it for now
   *
   * @return View
   */
  public function getIndex()
  {
    // Title
    $title = Lang::get('admin/categories/title.categories_management');

    return View::make('admin/categories/index', compact('title'));
  }

  /**
   * admin/categories/tree page
   * Categories tree management
   *
   * @return View
   */
  public function tree()
  {
    // Title
    $title = Lang::get('admin/categories/title.categories_tree_management');

    return View::make('admin/categories/tree', compact('title'));
  }

  /**
   * Return json for categories tree using jstree
   *
   * @return json
   */
  public function getDatadefault()
  {
    return Response::json(Category::jsTree('en'));
  }

  /**
   * Function used for update the arborescence
   * Return a json wich certified or deny the update
   *
   * @return json
   */
  public function update($category)
  {
    // Declare the rules for the validator
    $rules = array(
      '_parent' => 'required|numeric'
    );

    $ret = $this->basicValidator(Input::all(), $rules);
    $ret['node'] = $category;

    if ($ret['success'])
    {
      // update parent in db
      $category->parent_id = $ret['input']['_parent'];
      $category->save();

      // check if update has been save
      $category = Category::find($category->id);
      if ($category->parent_id == $ret['input']['_parent'])
        $ret['success'] = True;
      else
        $ret['errors'][] = Lang::get('admin/categories/messages.error.unknown');
      $ret['node'] = $category;
    }

    return Response::json($ret);
  }

  /**
   * Function used when adding a child node.
   * Return the id of the newly created node in database
   *
   * @return json
   */
  public function addchild()
  {
    // Declare the rules for the validator
    $rules = array(
      '_parent' => 'required|numeric'
    );

    $ret = $this->basicValidator(Input::all(), $rules);

    if ($ret['success'])
    {
      // create new entry in db
      $cat = new Category;
      $cat->parent_id = $ret['input']['_parent'];
      $cat->save();
      $ret['node'] = $cat->id;

      $cat_text = new Cats_text;
      $cat_text->cat_id = $cat->id;
      $cat_text->short_name = "default";
      $cat_text->long_name = "default";
      $cat_text->lang = "en";
      $cat_text->save();
    }

    return Response::json($ret);
  }

  /**
   * Rename a category in a given lang
   *
   * @return json
   */
  public function rename()
  {
    // Declare rules for validator
    $rules = array(
      '_id'   => 'required|numeric',
      '_long'  => 'required|string',
      '_short' => 'required|string',
      '_lang' => 'string',
    );

    $ret = $this->basicValidator(Input::all(), $rules);

    if ($ret['success'])
    {
      if (!isset($ret['input']['_lang']))
        $ret['input']['_lang'] = "en";
      $cat_text = Cats_text::where('cat_id', $ret['input']['_id'])
        ->where('lang', $ret['input']['_lang'])
        ->first();
      if (!$cat_text)
      {
        $cat_text = new Cats_text;
        $cat_text->cat_id = $ret['input']['_id'];
        $cat_text->lang = $ret['input']['_lang'];
      }
      $cat_text->short_name = $ret['input']['_short'];
      $cat_text->long_name = $ret['input']['_long'];
      $cat_text->save();
      $ret['cat'] = $cat_text;
    }
    return Response::json($ret);
  }

  /**
   * Function used when you want to delete a category
   *
   * @return json
   */
  public function delete($category)
  {
    $rules = array(
    );

    $ret = $this->basicValidator(Input::all(), $rules);
    if ($ret['success'])
    {
      if (isset($ret['input']['_children']))
        $to_delete = $ret['input']['_children'];
      else
        $to_delete = array();
      $to_delete[] = $category->id;
      Category::wherein('id', $to_delete)->delete();
      Posts_cat::wherein('cat_id', $to_delete)->delete();
    }
    return Response::json($ret);
  }

  /**
   * Basic validator and
   *
   * @return
   */
  private function basicValidator($input, $rules)
  {
    // in case the parent is '#'
    if (isset($input['_parent']) && $input['_parent'] == '#')
      $input['_parent'] = 0;

    // Run the validator
    $validator = Validator::make($input, $rules);

    // Object to return
    $ret = array(
      'success' => True,
      'errors'  => array(),
      'node'    => 0,
      'input'   => $input,
    );

    // Check if data are good
    if ($validator->fails())
    {
      foreach ($validator->messages()->all() as $key => $msg)
        $ret['errors'][] = $msg;
      $ret['success'] = False;
    }

    return $ret;
  }
}
