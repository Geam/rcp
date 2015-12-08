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
    $input = Input::all();
    return View::make('site/blog/index', compact('input'));
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
  public function getSearch()
  {
    $input = Input::all();

    // Rules for validator
    $rules = array(
      'category'    => 'regex:/[0-9]+(,[0-9]+)*/',
      'importance'  => 'min:0|max:4',
      'affair_id'   => 'min:2',
      'lang'        => 'size:2',
      'state'       => 'size:2',
      'date'        => 'date',
      'date_2'      => 'date',
      'oml'         => 'in:true,false',
      'nature'      => 'in:all,judgement,decision',
      'page'        => 'integer|min:0',
      'page_len'    => 'integer|min:10'
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
      select(array(
        'posts.*',
        DB::raw('group_concat(distinct `posts_texts`.`lang`, `posts_texts`.`title` separator \'|\') as `title`, group_concat(distinct `posts_texts`.`lang`) as `pt_lang`')
      ))->
      join('posts_texts', 'posts.id', '=', 'posts_texts.post_id')->
      join('posts_cats', 'posts.id', '=', 'posts_cats.post_id')->distinct()->groupBy('posts.id');

    // search the post that match categories
    if (Input::has('category') && $input['category'] != "") {
      $cat = explode(',', $input['category']);
      $posts = $posts->whereIn('cat_id', $cat);
    }

    // add filter by affair_id
    if (Input::has('affair_id'))
      $posts = $posts->where('affair_id', 'like', '%'.$input['affair_id'].'%');

    // add importance filter
    if (Input::has('importance') && $input['importance'] >= 1 && $input['importance'] <= 3)
      $posts = $posts->where('importance', $input['importance']);

    // add lang filter
    if (Input::has('lang') && $input['lang'] != '00')
      $posts = $posts->where('posts.lang', 'LIKE', '%' . $input['lang'] . '%');

    // add state filter
    if (Input::has('state') && $input['state'] != '00')
      $posts = $posts->where('state', $input['state']);

    // add nature filter
    if (Input::has('nature') && $input['nature'] != 'all')
      $posts = $posts->where('nature', $input['nature']);

    // add date filter
    if (Input::has('date')) {
      if (Input::has('date_2')) {
        $posts = $posts->wherebetween('p_date', [date('Y-m-d', strtotime($input['date'])), date('Y-m-d', strtotime($input['date_2']))]);
      } else {
        $posts = $posts->where('p_date', date('Y-m-d', strtotime($input['date'])));
      }
    }

    // if 'only my lang'
    if (Input::has('oml') && $input['oml'] == "true")
      $posts = $posts->where('posts_texts.lang', App::getLocale());

    // add title filter
    if (Input::has('title'))
      $posts = $posts->where('title', 'like', '%'.$input['title'].'%');

    // add content filter
    if (Input::has('content')) {
      foreach (explode('+', $input['content']) as $split_first) {
        $posts = $posts->where(function($query) use ($split_first) {
          foreach (explode('|', $split_first) as $key => $split_second) {
            if ($key == 0)
              $query = $query->where('content', 'like', '%' . $split_second . '%');
            else
              $query = $query->orWhere('content', 'like', '%' . $split_second . '%');
          }
        });
      }
    }

    // total number of query matching
    //$nb_matching = $posts->get()->count();

    // Launch the request
    //$posts = $posts->get();
    //$posts = $posts->limit($input['page_len'])->
    //  skip($input['page'] * $input['page_len'])->get();
    $posts = $posts->orderBy('p_date', 'desc')->paginate($input['page_len']);

    $ret = array();
    foreach ($posts as $post)
    {
      $title = '';
      $title_backup = '';
      foreach (explode('|', $post->title) as $value)
      {
        if (substr($value, 0, 2) == App::getLocale())
          $title = substr($value, 2);
      }
      if (! $title)
        $title = $post->meta_title;
      $ret[$post->id] = array(
        'affair_id'   => $post->affair_id,
        'importance'  => ($post->importance == 4) ? 'CR' : $post->importance,
        'lang'        => (!strpos($post->lang, ',')) ? Lang::get('langs.' . $post->lang) : $post->lang,
        'state'       => Lang::get('states.' . $post->state),
        'url'         => $post->url(),
        'nature'      => $post->nature,
        'date'        => date('d/m/Y', strtotime($post->p_date)),
        'title'       => $title,
        'lang_avail'  => $post->pt_lang,
      );
    }
//    $res = array('success' => 'True', 'data' => array_values($ret));
    $res = array(
      'page'              => $input['page'],
      'success'           => 'True',
      'data'              => array_values($ret),
      'sql'               => DB::getQueryLog(),
      'links'             => $posts->getLastPage(),
      );
    return Response::json($res);
  }
}
