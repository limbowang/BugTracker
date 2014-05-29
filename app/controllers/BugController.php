<?php


class BugController extends BaseController {

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
        $sort = Input::get('sort');
        $bugs = Bug::paginate(self::PAGE_NUMBER);
        $totalPage = Bug::count() / self::PAGE_NUMBER + 1;
        $this->layout->title = '漏洞';
        $this->layout->content = View::make('bug.index')
            ->with('bugs', $bugs)
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
        $this->layout->title = '发布新漏洞';
        $this->layout->content = View::make('bug.create');
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
            'name' => 'required|min:2|max:15',
            'details' => 'required|min:10|max:255',
            'os' => 'required|min:1|max:10',
            'software' => 'required|min:1|max:20',
            'level' => 'required',
            'tag' => 'max:150',
            'img' => 'image|max:2048'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('bug/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $bug = new Bug;
            $bug->user_id = Auth::id();
            $bug->name = Input::get('name');
            $bug->details = Input::get('details');
            $bug->os = Input::get('os');
            $bug->software = Input::get('software');
            $bug->level = Input::get('level');
            $bug->tag = Input::get('tag');
            // handle file upload
            if (Input::hasFile('img')) {
                $newFileName = str_random(40);
                Input::file('img')->move('bugimage', $newFileName);
                $bug->img = $newFileName;
            }
            $bug->save();

            // redirect
            Session::flash('message', 'Successfully created bug!');
            return Redirect::to('bug/' . $bug->id);
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
        $bug = Bug::findOrFail($id);
        $bug->read_count += 1;
        $bug->save();
        $page = Input::has('page') ? Input::get('page') : 1;
        $comments = Comment::where('bug_id', '=', $id)->paginate(self::PAGE_NUMBER);
        $this->layout->title = "漏洞 | " . $bug->name;
        $this->layout->content = View::make('bug.show')->with(array(
            'bug' => $bug,
            'page' => $page,
            'comments' => $comments,
            'comment_start' =>  self::PAGE_NUMBER * ($page - 1)
        ));
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
