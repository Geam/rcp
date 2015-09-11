<?php

class AdminBlogsController extends AdminController {

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
   * Show a list of all the blog posts.
   *
   * @return View
   */
  public function getIndex()
  {
    // Title
    $title = Lang::get('admin/blogs/title.blog_management');

    // url for dataTable ajax
    $url = URL::to('admin/affairs/manage/data');

    // Show the page
    return View::make('admin/blogs/index', compact('title', 'url'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function getCreate()
  {
    // Title
    $title = Lang::get('admin/blogs/title.create_a_new_blog');

    // Show the page
    return View::make('admin/blogs/create_edit', compact('title'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function postCreate()
  {
    // Declare the rules for the form validation
    $rules = array(
      'title'       =>  'required|min:3',
      'content'     =>  'required|min:3',
      'importance'  =>  'required|numeric|digits_between:0,3',
      'slug'        =>  'required|min:3|unique:posts,slug',
      'nature'      =>  array('required', 'Regex:/^(judgement|decision)$/'),
      'affair_id'   =>  'required|min:3',
      'post_lang'   =>  'required|between:2,3',
      'state'       =>  'required|min:2,3',
      'p_date'      =>  'required|date'
    );

    // Validate the inputs
    $validator = Validator::make($input = Input::all(), $rules);

    // Check if the form validates with success
    if ($validator->passes())
    {
      // Create a new blog post
      $user = Auth::user();

      // Update the blog post data
      $this->post->importance       = $input['importance'];
      $this->post->slug             = Str::slug($input['slug']);
      $this->post->nature           = $input['nature'];
      $this->post->affair_id        = $input['affair_id'];
      $this->post->lang             = $input['post_lang'];
      $this->post->state            = $input['state'];
      $this->post->p_date           = date('Y-m-d', strtotime($input['p_date']));
      $this->post->meta_title       = $input['meta-title'];
      $this->post->meta_description = $input['meta-description'];
      $this->post->meta_keywords    = $input['meta-keywords'];
      $this->post->user_id          = $user->id;

      // Was the blog post updated?
      if($this->post->save())
      {
        // Get Posts_text in english if already exist
        $posts_text = $this->post->hasMany('Posts_text')->where('lang', '=', "en")->first();

        // If it doesn't exist, create a new one
        if (! $posts_text)
          $posts_text         = new Posts_text;

        // Affect new value
        $posts_text->title    = $input['title'];
        $posts_text->content  = $input['content'];
        $posts_text->post_id  = $this->post->id;
        $posts_text->lang     = "en";

        // Was the posts_text updated ?
        if ($posts_text->save())
        {
          // Redirect to the new blog post page
          return Redirect::to('admin/affairs/manage/' . $this->post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
        }
      }

      // Redirect to the blogs post management page
      return Redirect::to('admin/affairs/manage/' . $this->post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
    }

    // Form validation failed
    return Redirect::to('admin/affairs/manage/create')->withInput()->withErrors($validator);
  }

  /**
   * Display the specified resource.
   *
   * @param $post
   * @return Response
   */
  public function getShow($post)
  {
    // redirect to the frontend
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param $post
   * @return Response
   */
  public function getEdit($post)
  {
    // Title
    $title = Lang::get('admin/blogs/title.blog_update');

    // Show the page
    return View::make('admin/blogs/create_edit', compact('post', 'title'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $post
   * @return Response
   */
  public function postEdit($post)
  {
    // Declare the rules for the form validation
    $rules = array(
      'title'       =>  'required|min:3',
      'content'     =>  'required|min:3',
      'importance'  =>  'required|numeric|digits_between:0,3',
      'slug'        =>  'required|min:3|unique:posts,slug,' . $post->id,
      'nature'      =>  array('required', 'Regex:/^(judgement|decision)$/'),
      'affair_id'   =>  'required|min:3',
      'post_lang'   =>  'required|between:2,3',
      'state'       =>  'required|min:2,3',
      'p_date'      =>  'required|date'
    );

    // Validate the inputs
    $validator = Validator::make($input = Input::all(), $rules);

    // Check if the form validates with success
    if ($validator->passes())
    {
      // Update the blog post data
      $post->importance       = $input['importance'];
      $post->slug             = Str::slug($input['slug']);
      $post->nature           = $input['nature'];
      $post->affair_id        = $input['affair_id'];
      $post->lang             = $input['post_lang'];
      $post->state            = $input['state'];
      $post->p_date           = date('Y-m-d', strtotime($input['p_date']));
      $post->meta_title       = $input['meta-title'];
      $post->meta_description = $input['meta-description'];
      $post->meta_keywords    = $input['meta-keywords'];

      // Was the blog post updated?
      if($post->save())
      {
        // Get Posts_text in english if already exist
        $posts_text = $post->hasMany('Posts_text')->where('lang', '=', "en")->first();

        // If it doesn't exist, create a new one
        if (! $posts_text)
          $posts_text         = new Posts_text;

        // Affect new value
        $posts_text->title    = $input['title'];
        $posts_text->content  = $input['content'];
        $posts_text->post_id  = $post->id;
        $posts_text->lang     = "en";

        // Was the posts_text updated ?
        if ($posts_text->save())
        {
          // Redirect to the new blog post page
          return Redirect::to('admin/affairs/manage/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
        }
      }

      // Redirect to the blogs post management page
      return Redirect::to('admin/affairs/manage/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
    }

    // Form validation failed
    return Redirect::to('admin/affairs/manage/' . $post->id . '/edit')->withInput()->withErrors($validator);
  }

  public function postCategory($post)
  {
    $rules = array(
      '_id'   => "required|string",
      '_cat'  => "array"
    );

    $validator = Validator::make($input = Input::all(), $rules);

    if ($validator->passes())
    {
      $post->categories()->sync($input['_cat']);
      return Response::json(array('success' => true));
    }
    return Response::json(array('success' => false));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param $post
   * @return Response
   */
  public function getContent($post)
  {
    // Title
    $title = Lang::get('admin/blogs/title.blog_update');

    // Get post post texts
    $post->store_texts();

    // Show the page
    return View::make('admin/blogs/create_edit', compact('post', 'title'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param $post
   * @return Response
   */
  public function getDelete($post)
  {
    // Title
    $title = Lang::get('admin/blogs/title.blog_delete');

    // Show the page
    return View::make('admin/blogs/delete', compact('post', 'title'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param $post
   * @return Response
   */
  public function postDelete($post)
  {
    // Declare the rules for the form validation
    $rules = array(
      'id' => 'required|integer'
    );

    // Validate the inputs
    $validator = Validator::make(Input::all(), $rules);

    // Check if the form validates with success
    if ($validator->passes())
    {
      $id = $post->id;
      $post->delete();

      // Was the blog post deleted?
      $post = Post::find($id);
      if(empty($post))
      {
        // Redirect to the blog posts management page
        return Redirect::to('admin/affairs/manage')->with('success', Lang::get('admin/blogs/messages.delete.success'));
      }
    }
    // There was a problem deleting the blog post
    return Redirect::to('admin/affairs/manage')->with('error', Lang::get('admin/blogs/messages.delete.error'));
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
      ->edit_column('importance', '{{ ($importance) ? $importance : "CR" }}')

      ->add_column('actions', '<a href="{{{ URL::to(\'admin/affairs/manage/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
      <a href="{{{ URL::to(\'admin/affairs/manage/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
      ')

      ->remove_column('id')

      ->make();
  }
}
