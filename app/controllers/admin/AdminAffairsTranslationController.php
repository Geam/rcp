<?php

class AdminAffairsTranslationController extends AdminController {

  /**
   * Post Model
   * @var Post
   */
  protected $post;

  /**
   * Inject the models.
   * @param Post $post
   */
  public function __construct(Post $post)
  {
    parent::__construct();
    $this->post = $post;
  }

  /**
   * Index page of the translation
   *
   * @return view
   */
  public function getIndex()
  {
    $title = Lang::get('admin/blogs/title.affair_translation');

    // url for datatable ajax
    $url = URL::to('admin/affairs/translate/data');
    return View::make('admin/blogs/translation', compact('title', 'url'));
  }

  /**
   * Edit page
   *
   * @return view
   */
  public function getEdit($post, $lang)
  {
    $title = Lang::get('admin/blogs/title.translate_affair') . ' ' .
      Lang::get('langs.' . $lang);

    return View::make('admin/blogs/translate', compact('title', 'post', 'lang'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $post
   * @return Response
   */
  public function postEdit($post, $lang)
  {
    // Declare the rules for the form validation
    $rules = array(
      'title'   => 'required|min:3',
      'content' => 'required|min:3'
    );

    // Validate the inputs
    $validator = Validator::make($input = Input::all(), $rules);

    // Check if the form validates with success
    if ($validator->passes())
    {
      $posts_text = $post->hasMany('Posts_text')->where('lang', '=', $lang)->first();

      // If it doesn't exist, create a new one
      if (!$posts_text)
        $posts_text = new Posts_text;

      $posts_text->title    = $input['title'];
      $posts_text->content  = str_replace(array("\n", "\r", "<p>&nbsp;</p>"), '', $input['content']);
      $posts_text->post_id  = $post->id;
      $posts_text->lang     = $lang;

      // Was the posts_text update ?
      if ($posts_text->save())
      {
        // Redirect to the new affair text
        return Redirect::to('admin/affairs/translate/' . $post->id . '/edit/' . $lang)->with('success', Lang::get('admin/blogs/messages.update.success'));
      }

      // Redirect to the affair translate page
      return Redirect::to('admin/affairs/translate/' . $post->id . '/edit/' . $lang)->with('error', Lang::get('admin/blogs/messages.update.error'));
    }

    // Form validation failed
    return Redirect::to('admin/affairs/translate/' . $post->id . '/edit/' . $lang)->withError($validator);
  }

  /**
   * Show a list of all the blog posts formatted for Datatables.
   *
   * @return Datatables JSON
   */
  public function getData()
  {
    $posts = Post::join('posts_texts', 'posts.id', '=', 'posts_texts.post_id')
      ->select('posts.id', 'posts_texts.title', 'posts.affair_id', 'posts.importance', 'posts.lang', 'posts.state')
      ->where('posts_texts.lang', '=', 'en');
    return Datatables::of($posts)

      ->edit_column('lang', '{{ Lang::get(\'langs.\' . $lang) }}')
      ->edit_column('state', '{{ Lang::get(\'states.\' . $state) }}')
      ->edit_column('importance', '{{ ($importance == 4) ? "CR" : $importance }}')

      ->add_column('actions', '<a href="{{{ URL::to(\'admin/affairs/translate/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
      ')

      ->remove_column('id')

      ->make();
  }
}
//      ->add_column('actions', '<div href="{{{ URL::to(\'admin/affairs/translate/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</div>
