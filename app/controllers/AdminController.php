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
    public function __construct() {
        $this->beforeFilter('admin');
    }

    public function getIndex() {
        return Redirect::to('/admin/users');
    }

    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function getUsers() {
        $users = User::paginate(self::PAGE_NUMBER);
        $this->layout->title = '所有用户';
        $this->layout->content = View::make('admin.users')->with(array(
            'users' => $users
        ));
    }

    /**
     * Display a listing of the bugs.
     *
     * @return Response
     */
    public function getBugs() {
        $bugs = Bug::orderBy('id', 'desc')->paginate(self::PAGE_NUMBER);
        $this->layout->title = '所有漏洞';
        $this->layout->content = View::make('admin.bugs')->with(array(
            'bugs' => $bugs
        ));
    }

    /**
     * Display a listing of the comments.
     *
     * @return Response
     */
    public function getComments() {
        $comments = Comment::whereHas('bug', function ($query) {
            $query->withTrashed();
        })
            ->orderBy('id', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '所有评论';
        $this->layout->content = View::make('admin.comments')->with(array(
            'comments' => $comments
        ));
    }

    /**
     * Display a listing of the posts.
     *
     * @return Response
     */
    public function getPosts() {
        $posts = Post::orderBy('id', 'desc')->paginate(self::PAGE_NUMBER);
        $this->layout->title = '所有帖子';
        $this->layout->content = View::make('admin.posts')->with(array(
            'posts' => $posts
        ));
    }

    /**
     * Display a listing of the replies.
     *
     * @return Response
     */
    public function getReplies() {
        $replies = Reply::with('post')
            ->has('post')
            ->orderBy('id', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '所有回复';
        $this->layout->content = View::make('admin.replies')->with(array(
            'replies' => $replies
        ));
    }
} 