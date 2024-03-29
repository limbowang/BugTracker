<?php

class CommentController extends \BaseController {

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
            return Redirect::to('bug/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $comment = new Comment;
            $comment->content = Input::get('content');
            $comment->user_id = Auth::id();
            $comment->bug_id = $id;
            $comment->save();
            // redirect
            Session::flash('message', '评论成功');
            return Redirect::to('bug/' . $id);
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
        $comment = Comment::find($id);
        if (empty($comment)) {
            Session::flash('error', '该评论不存在');
        } else if ($comment->user_id != Auth::id() && !Auth::user()->is_admin) {
            Session::flash('error', '无法删除该评论');
        } else {
            $comment->delete();
            Session::flash('message', '删除成功');
        }
        return Redirect::back();
	}


}
