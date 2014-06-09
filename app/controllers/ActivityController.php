<?php

class ActivityController extends \BaseController {

    /**
     * Instantiate a new BbsController instance.
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
        $activity = null;
        $activities = Activity::orderBy('created_at', 'desc')->paginate(self::PAGE_NUMBER);

        $this->layout->title = '活动';
        $this->layout->content = View::make('activity.index')->with(array(
            'activities' => $activities,
            'relatedActivities' => Activity::limit(self::SIDEBAR_LIMITS)->get()
        ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        $this->layout->title = '发布新活动';
        $this->layout->content = View::make('activity.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        $rules = array(
            'title' => 'min:2|max:15',
            'description' => 'min:10|max:255'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('activity/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $activity = new Activity;
            $activity->user_id = Auth::id();
            $activity->title = Input::get('title');
            $activity->description = Input::get('description');
            $activity->save();

            Session::flash('message', '发布活动成功!');
            return Redirect::to('activity/' . $activity->id);
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
        $activity = Activity::find($id);
        if (empty($activity)) {
            Session::flash('error', '该活动不存在或已被删除');
            return Redirect::to('/activity');
        } else {
            $this->layout->title = $activity->title;
            $this->layout->content = View::make('activity.show')->with(array(
                'activity' => $activity,
                'all_topics' => Topic::all(),
                'relatedActivities' => Activity::limit(self::SIDEBAR_LIMITS)->get()
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
        $activity = Activity::find($id);
        if (!Auth::user()->is_admin && $activity->user_id != Auth::id()) {
            App::abort(403);
        }

        $this->layout->title = '更新 | ' . $activity->title;
        $this->layout->content = View::make('activity.edit')
            ->with('activity', $activity);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id) {
        //
        $activity = Post::findOrFail($id);

        if (!Auth::user()->is_admin && $activity->user_id != Auth::id()) {
            Session::flash('message', '更新失败');
            return Redirect::back(403);
        }

        $rules = array(
            'title' => 'required|min:2|max:50',
            'content' => 'required|min:10|max:255',
            'topic' => 'exists:bbs_topic,id'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('bbs/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            if (Input::has('title')) {
                $activity->title = Input::get('title');
            }
            if (Input::has('description')) {
                $activity->description = Input::get('description');
            }
            $activity->update();

            // redirect
            Session::flash('message', '更新成功');
            return Redirect::to('/activity/' . $activity->id);
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
        $activity = Activity::find($id);
        if (empty($activity)) {
            Session::flash('error', '该活动不存在');
        } else if ($activity->user_id != Auth::id() && !Auth::user()->is_admin) {
            Session::flash('error', '无法删除该活动');
        } else {
            $activity->delete();
            Session::flash('message', '删除成功');
        }
        return Redirect::back();
    }

//    public function participate($id) {
//        $activity = Activity::find($id);
//        if (empty($activity)) {
//            Session::flash('error', '该活动不存在');
//        } else if (!$activity->hasOne('user')) {
//            $activity->users()->attach(Auth::id());
//        }
//        Session::flash('message', '参加成功');
//        return Redirect::back();
//    }
//
//    public function leave($id) {
//        $activity = Activity::find($id);
//        if (empty($activity)) {
//            Session::flash('error', '该活动不存在');
//        } else if (!$activity->hasOne('user')) {
//            $activity->users()->detach(Auth::id());
//        }
//        Session::flash('message', '参加成功');
//        return Redirect::back();
//    }
}
