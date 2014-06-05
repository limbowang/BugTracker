<?php

class ReplyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		//
        $rules = array(
            'content' => 'required|min:2|max:255'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('bbs/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $reply = new Reply;
            $reply->content = Input::get('content');
            $reply->user_id = Auth::id();
            $reply->post_id = $id;
            $reply->save();
            // redirect
            Session::flash('message', '回复成功');
            return Redirect::to('bbs/' . $id);
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
        $reply = Reply::find($id);
        if (empty($reply)) {
            Session::flash('error', '该回复不存在');
        } else if ($reply->user_id != Auth::id() && !Auth::user()->is_admin) {
            Session::flash('error', '无法删除该回复');
        } else {
            $reply->delete();
            Session::flash('message', '删除成功');
        }
        return Redirect::back();
	}


}
