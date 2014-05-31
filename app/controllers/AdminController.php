<?php
/**
 * Created by PhpStorm.
 * User: Limbo
 * Date: 14-5-31
 * Time: 下午8:26
 */

class AdminController extends BaseController {

    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('admin');
    }

    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function getUsers() {
        $this->layout->title = '所有用户';
        $this->layout->content = View::make('admin.users');
    }

    /**
     * Display a listing of the bugs.
     *
     * @return Response
     */

    /**
     * Display a listing of the comments.
     *
     * @return Response
     */

    /**
     * Display a listing of the posts.
     *
     * @return Response
     */

    /**
     * Display a listing of the replies.
     *
     * @return Response
     */
} 