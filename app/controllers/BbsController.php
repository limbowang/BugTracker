<?php


class BbsController extends \BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => array('index', 'show')));

        $this->beforeFilter('csrf', array('on' => 'post'));

    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $posts = Post::paginate(self::PAGE_NUMBER);
        $totalPage = Post::count() / self::PAGE_NUMBER + 1;
        $this->layout->title = '讨论';
        $this->layout->content = View::make('bbs.index')
            ->with('posts', $posts)
            ->with('total', $totalPage);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $this->layout->title = '发布新帖';
        $topics = array();;
        foreach(Topic::all(array('id', 'name')) as $topic) {
            $topics[$topic->id] = $topic->name;
        }
        $this->layout->content = View::make('bbs.create')
            ->with('topics', $topics);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $rules = array(
            'title' => 'required|min:2|max:50',
            'content' => 'required|min:10|max:255',
            'topic' => 'exists:bbs_topic,id'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('bbs/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $post = new Post;
            $post->title = Input::get('title');
            $post->content = Input::get('content');
            $post->user_id = Auth::id();
            $post->topic_id = Input::get('topic');
            $post->save();

            // redirect
            Session::flash('message', 'Successfully created post!');
            return Redirect::to('bbs/' . $post->id);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        $post = Post::findOrFail($id);
        $post->read_count += 1;
        $post->save();
        $this->layout->title = '讨论 | ' . $post->title;
        $this->layout->content = View::make('bbs.show')
            ->with('post', $post);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
