<?php


class BugController extends BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except' => array('index', 'show')));

        $this->beforeFilter('csrf', array('on' => 'post'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $bugs = null;
        $sort = 'new';
        if (Input::has('sort')) {
            $sort = Input::get('sort');
            if ($sort == 'pop') {
                $bugs = Bug::orderBy('read_count', 'desc')->paginate(self::PAGE_NUMBER);
            } else if ($sort == 'most-commented') {
                $cols = array('bug.id', 'name', 'software', 'os', 'bug.user_id', 'bug.created_at', DB::raw('count(bug_comment.id) as cnt'));
                $bugs = Bug::leftJoin('bug_comment', 'bug.id', '=', 'bug_comment.bug_id')
                    ->groupBy('bug.id')
                    ->orderBy('cnt', 'desc')
                    ->orderBy('bug.created_at', 'desc')
                    ->paginate(self::PAGE_NUMBER, $cols);
            } else {
                $bugs = Bug::orderBy('created_at', 'desc')->paginate(self::PAGE_NUMBER);
            }
        } else {
            $bugs = Bug::orderBy('created_at', 'desc')->paginate(self::PAGE_NUMBER);
        }
        $this->layout->title = '漏洞';
        $this->layout->content = View::make('bug.index')
            ->with('bugs', $bugs)
            ->with('sort', $sort)
            ->with('sortlist', array('new' => '最新', 'pop' => '最热门', 'most-commented' => '评论最多'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        $this->layout->title = '发布新漏洞';
        $this->layout->content = View::make('bug.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
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
                Input::file('img')->move('bugimages', $newFileName);
                $bug->img = '/bugimages/' . $newFileName;;
            }
            $bug->save();

            // redirect
            Session::flash('message', '发布漏洞成功');
            return Redirect::to('bug/' . $bug->id);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        //
        $bug = Bug::find($id);
        if (empty($bug)) {
            Session::flash('error', '该漏洞不存在或已被删除');
            return Redirect::to('/bug');
        } else {
            $bug->read_count += 1;
            $bug->save();
            $page = Input::has('page') ? Input::get('page') : 1;
            $comments = Comment::where('bug_id', '=', $id)->withTrashed()->paginate(self::PAGE_NUMBER);
            $this->layout->title = $bug->name;
            $this->layout->content = View::make('bug.show')->with(array(
                'bug' => $bug,
                'page' => $page,
                'comments' => $comments,
                'comment_start' => self::PAGE_NUMBER * ($page - 1),
                'latest_bugs' => Bug::orderBy('created_at', 'desc')->limit(self::SIDEBAR_LIMITS)->get(),
                'hottest_bugs' => Bug::orderBy('read_count', 'desc')->limit(self::SIDEBAR_LIMITS)->get()
            ));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        //
        $bug = Bug::find($id);
        if (empty($bug)) {
            Session::flash('error', '该漏洞不存在');
            return Redirect::to('/bug');
        } else if ($bug->user_id != Auth::id() && !Auth::user()->is_admin) {
            Session::flash('error', '没有权限更新漏洞');
            return Redirect::to('/bug');
        } else {
            $this->layout->title = '更新 | ' . $bug->name;
            $this->layout->content = View::make('bug.edit')
                ->with('bug', $bug);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id) {
        //
        $bug = Bug::find($id);
        if (empty($bug)) {
            Session::flash('error', '该漏洞不存在');
            return Redirect::to('/bug');
        } else if ($bug->user_id != Auth::id() && !Auth::user()->is_admin) {
            Session::flash('error', '没有权限更新漏洞');
            return Redirect::to('/bug');
        } else {
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
                return Redirect::to('bug/edit')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $bug->name = Input::get('name');
                $bug->details = Input::get('details');
                $bug->os = Input::get('os');
                $bug->software = Input::get('software');
                $bug->level = Input::get('level');
                $bug->tag = Input::get('tag');
                // handle file upload
                if (Input::hasFile('img')) {
                    $newFileName = str_random(40);
                    Input::file('img')->move('bugimages', $newFileName);
                    $bug->img = '/bugimages/' . $newFileName;
                }
                $bug->update();

                Session::flash('message', '更新成功');
                return Redirect::to('/bug/' . $bug->id)
                    ->with('bug', $bug);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        //
        $bug = Bug::find($id);
        if (empty($bug)) {
            Session::flash('error', '该漏洞不存在');
        }  else if ($bug->user_id != Auth::id() && !Auth::user()->isAdmin()) {
            Session::flash('error', '无法删除该贴');
        } else {
            $bug->delete();
            Session::flash('message', '删除成功');
        };
        return Redirect::back();
    }
}
