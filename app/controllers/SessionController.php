<?php

class SessionController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
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
        $this->layout->title = '登陆';
        $this->layout->content = View::make('session.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );

        $inputs = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        $isRemember = Input::get('rememberme') == 'on';

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('signin')
                ->withErrors($validator);
        } else if (Auth::attempt($inputs, $isRemember)) {
            return Redirect::back()
                ->with(array('message' => '登陆成功'));
        } else {
            return Redirect::to('signin')
                ->with(array('message' => '用户名或密码不正确'));
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
     * @return Response
     */
    public function destroy() {
        //
        Auth::logout();
        return Redirect::intended('/');
    }


}
