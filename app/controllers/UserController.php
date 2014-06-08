<?php


class UserController extends BaseController {


    /**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except' => array('create', 'show')));
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('admin', array('only' => array('destroy')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    public function index() {
//        // get all users
//        $users = User::all();
//        $this->layout->title = '所有用户';
//        $this->layout->content = View::make('user.index')->with('users', $users);
//    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        if (Auth::check()) {
            return Redirect::intended('/');
        }
        $this->layout->title = '注册';
        $this->layout->content = View::make('user.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        $rules = array(
            'username' => 'required|regex:/^(\w){5,15}$/|unique:user',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6|max:20',
            'password_confirmation' => 'required|same:password'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('signup')
                ->withErrors($validator)
                ->withInput(Input::except('password', 'password_confirmation'));
        } else {
            // store
            $user = new User;
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            // redirect
            Session::flash('message', 'Successfully created nerd!');
            Auth::loginUsingId($user->id);
            return Redirect::back();
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
        $viewMap = array(
            'bugs' => 'user.show.bugs',
            'comments' => 'user.show.comments',
            'posts' => 'user.show.posts',
            'replies' => 'user.show.replies'
        );
        $cateList = array(
            'bugs' => '漏洞',
            'comments' => '评论',
            'posts' => '帖子',
            'replies' => '回复'
        );
        $user = User::findOrFail($id);
        $data = null;
        $category = Input::get('c');
        if (!in_array($category, array_keys($viewMap))) {
            $category = 'bugs';
        }
        if ($category == 'bugs') {
            $data = Bug::where('user_id', '=', $user->id)->paginate(self::PAGE_NUMBER);
        } else if ($category == 'comments') {
            $data = Comment::where('user_id', '=', $user->id)->paginate(self::PAGE_NUMBER);
        } else if ($category == 'posts') {
            $data = Post::where('user_id', '=', $user->id)->paginate(self::PAGE_NUMBER);
        } else if ($category == 'replies') {
            $data = Reply::where('user_id', '=', $user->id)->paginate(self::PAGE_NUMBER);
        }
        $this->layout->title = $user->username;
        $this->layout->content = View::make($viewMap[$category])->with(array(
            'category' => $category,
            'lists' => $cateList,
            'user' => $user,
            'data' => $data
        ));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id) {
        //
        if (!Input::has('type')) {
            App::abort(500);
        }
        $type = Input::get('type');
        $user = Auth::user();
        if ($type == 'p') { // profile
            $rules = array(
                'email' => 'required|email|unique:user,email,' . Auth::id(),
                'avatar' => 'image|max:2048',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::back()
                    ->with('user', $user)
                    ->withErrors($validator);
            } else {
                // update
                $email = Input::get('email');
                if ($user->email != $email) {
                    $user->email = $email;
                }
                if (Input::hasFile('avatar')) {
                    $newFileName = str_random(40);
                    Input::file('avatar')->move('avatars', $newFileName);
                    $user->avatar = '/avatars/' . $newFileName;
                }
                $user->save();

                // redirect
                Session::flash('message', '保存成功');
                return Redirect::back()
                    ->with('user', $user);
            }
        } else if ($type == 's') {
            $rules = array(
                'old_password'=> 'required_with:new_password|passcheck',
                'new_password' => 'min:6|max:20|different:old_password',
                'new_password_confirmation' => 'required_with:new_password|same:new_password',
                'answer' => 'exists:user,answer,id,' . Auth::id(),
                'new_question' => 'min:2|max:20',
                'new_answer' => 'required_with:new_question|min:2|max:20',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput(Input::except('old_password', 'password', 'password_confirmation'))
                    ->with('user', $user);
            } else {
                // update
                if (Input::has('new_question')) {
                    $user->question = Input::get('new_question');
                    $user->answer = Input::get('new_answer');
                }
                if (Input::has('new_password')) {
                    $user->password = Hash::make(Input::get('new_password'));
                }
                $user->save();
                // redirect
                Session::flash('message', '保存成功');
                return Redirect::back()->
                    with('user', $user);
            }
        } else {
            App::abort(500);
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
        $user = User::find($id);
        if (empty($user)) {
            Session::flash('error', '该用户不存在');
        } else {
            $user->delete();
        }
        return Redirect::back();
    }


}
