<?php
/**
 * Created by PhpStorm.
 * User: Limbo
 * Date: 14-5-31
 * Time: 下午8:25
 */

class DashboardController extends BaseController {

    /**
     * Instantiate a new DashboardController instance.
     */
    public function __construct() {
        $this->beforeFilter('auth');
    }

    /**
     * Display users' profile.
     *
     * @return Response
     */
    public function getProfile() {
        $this->layout->title = '个人资料';
        $this->layout->content = View::make('dashboard.profile');
    }

    /**
     * Display security and password.
     *
     * @return Response
     */
    public function getSecurity() {
        $this->layout->title = '安全与密码';
        $this->layout->content = View::make('dashboard.security');
    }

    /**
     * Display .users' bugs
     *
     * @return Response
     */
    public function getMybugs() {
        $bugs = Bug::with('user')
            ->where('user_id', '=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '我的漏洞';
        $this->layout->content = View::make('dashboard.bugs')
            ->with('bugs', $bugs);
    }

    /**
     * Display users' received comments.
     *
     * @return Response
     */
    public function getCommentsReceived() {
        $comments = Comment::with(array('bug' => function ($query) {
                $query->where('user_id', '=', Auth::id())->withTrashed();
            }))
            ->whereHas('bug', function($query) {
                $query->where('user_id', '=', Auth::id());
            })
            ->where('bug_comment.user_id', '!=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '收到的评论';
        $this->layout->content = View::make('dashboard.comments')
            ->with('comments', $comments);
    }

    /**
     * Display a user's comments.
     *
     * @return Response
     */
    public function getMycomments() {
        $comments = Comment::with(array('bug' => function ($query) {
                $query->withTrashed();
            }))
            ->where('user_id', '=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '我的评论';
        $this->layout->content = View::make('dashboard.mycomments')
            ->with('comments', $comments);
    }

    /**
     * Display .users' posts
     *
     * @return Response
     */
    public function getMyposts() {
        $posts = Post::with('user')
            ->where('user_id', '=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '我的帖子';
        $this->layout->content = View::make('dashboard.posts')
            ->with('posts', $posts);
    }

    /**
     * Display users' received replies.
     *
     * @return Response
     */
    public function getRepliesReceived() {
        $replies = Reply::with(array('post' => function ($query) {
                $query->where('user_id', '=', Auth::id())->withTrashed();
            }))
            ->whereHas('post', function($query) {
                $query->where('user_id', '=', Auth::id());
            })
            ->where('user_id', '!=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '收到的回复';
        $this->layout->content = View::make('dashboard.replies')
            ->with('replies', $replies);
    }

    /**
     * Display a user's replies.
     *
     * @return Response
     */
    public function getMyreplies() {
        $replies = Reply::with(array('post' => function ($query) {
                $query->withTrashed();
            }))
            ->where('user_id', '=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGE_NUMBER);
        $this->layout->title = '我的回复';
        $this->layout->content = View::make('dashboard.myreplies')
            ->with('replies', $replies);
    }
} 