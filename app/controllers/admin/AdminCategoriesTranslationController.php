<?php

class AdminCategoriesTranslationController extends AdminCategoriesController
{
  /**
   * Inject the models
   * @param Category $category
   */
  public function __construct(Category $category)
  {
    parent::__construct($category);
  }

  /**
   * Main page for the categories translation
   *
   * @return View
   */
  public function getIndex()
  {
    // Title
    $title = Lang::get('admin/categories/title.categories_translation');

    return View::make('admin/categories/translation', compact('title'));
  }

  /**
   * Return the tree but the ask language
   *
   * @return json
   */
  public function getData($lang)
  {
    return Response::json(Category::jsTree($lang));
  }

  /**
   * Redirect on the parent class rename function (it's the same but,
   * with route access condition, I need to do that)
   *
   * @return json
   */
  public function postRename()
  {
    return parent::rename();
  }

}
