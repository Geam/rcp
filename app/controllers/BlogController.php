<?php

class BlogController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $post, User $user)
    {
        parent::__construct();

        $this->post = $post;
        $this->user = $user;
    }

  /**
   * Returns all the blog posts.
   *
   * @return View
   */
  public function getIndex()
  {
    // Get all the blog posts
    $posts = $this->post->orderBy('created_at', 'DESC')->paginate(10);

    // Get the category tree
    $tree = Category::getTree();

    // Show the page
    return View::make('site/blog/index', compact('posts', 'posts_texts', 'tree'));
  }

  /**
   * View a blog post.
   *
   * @param  string  $slug
   * @return View
   * @throws NotFoundHttpException
   */
  public function getView($slug)
  {
    // Get this blog post data
    $post = $this->post->where('slug', '=', $slug)->first();

    // Check if the blog post exists
    if (is_null($post))
    {
      // If we ended up in here, it means that
      // a page or a blog post didn't exist.
      // So, this means that it is time for
      // 404 error page.
      return App::abort(404);
    }

    // Show the page
    return View::make('site/blog/view_post', compact('post'));
  }

  /**
   * Return the category tree for the main page
   *
   * @return json
   */
  public function getCattree()
  {
    return Response::json(Category::jsTree(App::getLocale()));
  }

  /**
   * Manage the filter for the main page
   *
   * @return json
   */
  public function postSearch()
  {
//    return Response::json(Input::all());
//    dd(Input::all());

    $input = Input::all();

//    dd(Input::all());

    // Rules for validator
    $rules = array(
      'category'    => 'array',
      'importance'  => 'min:0|max:3',
      'affair_id'   => 'min:2',
      'lang'        => 'size:2',
      'state'       => 'size:2',
      'date'        => 'date',
      'date_2'      => 'date',
    );

    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
      $ret = array('success' => false, 'msgs' => array());
      foreach ($validator->messages()->all() as $key => $msg)
        $ret['msgs'][] = $msg;
        $ret['data'] = array();
      return Response::json($ret);
    }

    // Initialise request
    $posts = $this->post->
      select('posts.*','posts_texts.title','posts_texts.content','posts_texts.lang AS pt_lang')->
      join('posts_texts', 'posts.id', '=', 'posts_texts.post_id')->
      join('posts_cats', 'posts.id', '=', 'posts_cats.post_id')->distinct();

    // search the post that match categories
    if (Input::has('category') && count($input['category']) > 0)
      $posts = $posts->whereIn('cat_id', $input['category']);

    // add filter by affair_id
    if (Input::has('affair_id'))
      $posts = $posts->where('affair_id', 'like', '%'.$input['affair_id'].'%');

    // add importance filter
    if (Input::has('importance') && $input['importance'] >= 1 && $input['importance'] <= 3)
      $posts = $posts->where('importance', $input['importance']);

    // add lang filter
    if (Input::has('lang') && $input['lang'] != '00')
      $posts = $posts->where('lang', $input['lang']);

    // add state filter
    if (Input::has('state') && $input['state'] != '00')
      $posts = $posts->where('state', $input['state']);

    // add date filter
    if (Input::has('date')) {
      if (Input::has('date_2')) {
        $posts = $posts->wherebetween('p_date', [date('Y-m-d', strtotime($input['date'])), date('Y-m-d', strtotime($input['date_2']))]);
      } else {
        $posts = $posts->where('p_date', date('Y-m-d', strtotime($input['date'])));
      }
    }

    // add title filter
    if (Input::has('title'))
      $posts = $posts->where('title', 'like', '%'.$input['title'].'%');

    // add content filter
    if (Input::has('content'))
      $posts = $posts->where('content', 'like', '%'.$input['content'].'%');

    // Launch the request
    $posts = $posts->get();

    $ret = array();
    foreach ($posts as $post)
    {
      if (! isset($ret[$post->id]))
        $ret[$post->id] = [];
      if ($post->lang == $post->pt_lang) {
          $ret[$post->id]['affair_id']  = $post->affair_id;
          $ret[$post->id]['importance'] = $post->importance;
          $ret[$post->id]['lang']       = Lang::get('langs.' . $post->lang);
          $ret[$post->id]['state']      = Lang::get('states.' . $post->state);
          $ret[$post->id]['url']        = $post->url();
          $ret[$post->id]['nature']     = $post->nature;
          $ret[$post->id]['date']       = date('d/m/Y', strtotime($post->p_date));
          $ret[$post->id]['title']      = $post->title;
          $ret[$post->id]['content']    = $post->content;
      } else {
        if (!isset($ret[$post->id]['alt']))
          $ret[$post->id]['alt'] = [];
        $ret[$post->id]['alt'][$post->pt_lang] = [
          'title' => $post->title,
          'content' => $post->content
        ];
      }
    }
//    $res = array('success' => 'True', 'data' => array_values($ret), 'sql' => DB::getQueryLog());
    $res = array('success' => 'True', 'data' => array_values($ret));
    return Response::json($res);
  }
}
