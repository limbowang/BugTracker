<?php

use Illuminate\Support\MessageBag;

class UserController extends BaseController {


    /**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // get all users
        $users = User::all();
        $this->layout->title = '所有用户';
        $this->layout->content = View::make('user.index')->with('users', $users);
    }


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
            return Redirect::to('user');
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
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }


}
