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

    // Get this post comments
    $comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $user = $this->user->currentUser();
        $canComment = false;
        if(!empty($user)) {
            $canComment = $user->can('post_comment');
        }

    // Show the page
    return View::make('site/blog/view_post', compact('post', 'comments', 'canComment'));
  }

  /**
   * View a blog post.
   *
   * @param  string  $slug
   * @return Redirect
   */
  public function postView($slug)
  {

    $user = $this->user->currentUser();
    $canComment = $user->can('post_comment');
    if ( ! $canComment)
    {
      return Redirect::to($slug . '#comments')->with('error', 'You need to be logged in to post comments!');
    }

    // Get this blog post data
    $post = $this->post->where('slug', '=', $slug)->first();

    // Declare the rules for the form validation
    $rules = array(
      'comment' => 'required|min:3'
    );

    // Validate the inputs
    $validator = Validator::make(Input::all(), $rules);

    // Check if the form validates with success
    if ($validator->passes())
    {
      // Save the comment
      $comment = new Comment;
      $comment->user_id = Auth::user()->id;
      $comment->content = Input::get('comment');

      // Was the comment saved with success?
      if($post->comments()->save($comment))
      {
        // Redirect to this blog post page
        return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
      }

      // Redirect to this blog post page
      return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
    }

    // Redirect to this blog post page
    return Redirect::to($slug)->withInput()->withErrors($validator);
  }

  public function postSearch()
  {
//    return Response::json(Input::all());

    // Rules for validator
    $rules = array(
      'category'  => 'Regex:/^[0-9](,[0-9]{1,3})*$/',
    );

    $validator = Validator::make($input = Input::all(), $rules);

    if (! $validator)
      return Response::json(null);


    // Initialise request
    $posts = $this->post->select('posts.*')->distinct();

    // search the post that match categories
    if ($input['category'] != '0')
      $posts = $posts->join('posts_cats', 'post_id', '=', 'posts.id')->whereIn('cat_id', explode(',', $input['category']));

    // Launch the request
    $posts = $posts->get();
//    dd(DB::getQueryLog());
//    dd($posts);
    $ret = array();
    foreach ($posts as $post)
    {
      $temp = array(
        'affair_id'   => $post->affair_id,
        'importance'  => $post->importance,
        'lang'        => $post->lang,
        'state'       => $post->state,
        'slug'        => $post->sluge,
        'url'         => $post->url(),
        'nature'      => $post->nature,
        'title'       => $post->title(),
        'content'     => $post->content(),
      );
      $ret[] = $temp;
    }
    return Response::json($ret);
  }
}
