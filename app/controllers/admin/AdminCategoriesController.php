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

  public function getIndex()
  {
    // Title
    $title = Lang::get('admin/categories/title.categories_management');

    return View::make('admin/categories/index', compact('title'));
  }

}
?>
