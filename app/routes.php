<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('category', 'Category');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('category', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

# Apply the detectLang filter to all page but admin
Route::group(array('before' => 'detectLang'), function()
{

  /** ------------------------------------------
   *  Admin Routes
   *  ------------------------------------------
   */
  Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
  {
    # Categories Management
    Route::group(array('prefix' => 'categories'), function()
    {
      Route::group(array('prefix' => 'manage'), function()
      {
        Route::post('{category}/update', 'AdminCategoriesController@postUpdate');
        Route::post('{category}/delete', 'AdminCategoriesController@postDelete');
        Route::post('addchild', 'AdminCategoriesController@postAddchild');
        Route::post('rename', 'AdminCategoriesController@postRename');
      });
      Route::controller('/', 'AdminCategoriesController');
    });

    # Blog Management
    Route::group(array('prefix' => 'blogs'), function()
    {
      Route::get('{post}/show', 'AdminBlogsController@getShow');
      Route::get('{post}/edit', 'AdminBlogsController@getEdit');
      Route::post('{post}/edit', 'AdminBlogsController@postEdit');
      Route::get('{post}/content', 'AdminBlogsController@getContent');
      Route::post('{post}/content', 'AdminBlogsController@postContent');
      Route::get('{post}/delete', 'AdminBlogsController@getDelete');
      Route::post('{post}/delete', 'AdminBlogsController@postDelete');
      Route::controller('/', 'AdminBlogsController');
    });

    # User Management
    Route::group(array('prefix' => 'users'), function()
    {
      Route::get('{user}/show', 'AdminUsersController@getShow');
      Route::get('{user}/edit', 'AdminUsersController@getEdit');
      Route::post('{user}/edit', 'AdminUsersController@postEdit');
      Route::get('{user}/delete', 'AdminUsersController@getDelete');
      Route::post('{user}/delete', 'AdminUsersController@postDelete');
      Route::controller('/', 'AdminUsersController');
    });

    # User Role Management
    Route::group(array('prefix' => 'roles'), function()
    {
      Route::get('{role}/show', 'AdminRolesController@getShow');
      Route::get('{role}/edit', 'AdminRolesController@getEdit');
      Route::post('{role}/edit', 'AdminRolesController@postEdit');
      Route::get('{role}/delete', 'AdminRolesController@getDelete');
      Route::post('{role}/delete', 'AdminRolesController@postDelete');
      Route::controller('/', 'AdminRolesController');
    });

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
  });

  Route::get('categories', function()
  {
    return json_encode(Category::getTree(), JSON_PRETTY_PRINT);
  });

  Route::get('cattree', 'BlogController@getCattree');

  # SQL debug
  Route::get('sql', function()
  {
    return DB::getQueryLog();
  });

  /** ------------------------------------------
   *  User Routes
   *  ------------------------------------------
   */
  Route::group(array('prefix' => 'user'), function()
  {
    // User reset routes
    Route::get('reset/{token}', 'UserController@getReset');
    // User password reset
    Route::post('reset/{token}', 'UserController@postReset');
    //:: User Account Routes ::
    Route::post('{user}/edit', 'UserController@postEdit');

    //:: User Account Routes ::
    Route::post('login', 'UserController@postLogin');

    # User RESTful Routes (Login, Logout, Register, etc)
    Route::controller('/', 'UserController');
  });

  # search result
  Route::post('search', 'BlogController@postSearch');

  # language selector
  Route::get('language/{lang}', array(
    'as' => 'language.select',
    'uses'  => 'LanguageController@select'
  ));

  //:: Application Routes ::

  # Filter for detect language
  Route::when('contact-us','detectLang');

  # Contact Us Static Page
  Route::get('contact-us', function()
  {
    // Return about us page
    return View::make('site/contact-us');
  });

  # Posts - Second to last set, match slug
  Route::get('{postSlug}', 'BlogController@getView');

  # Index Page - Last route, no matches
  Route::get('/', array('as' => 'home', 'uses' => 'BlogController@getIndex'));

});
