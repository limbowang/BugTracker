<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function getIndex() {
        $this->layout->title = 'Home';
        $this->layout->content = View::make('home.index');
    }

    public function getSearch() {
        $keyword = Input::get('keyword');
        $keywordPattern = '%' . $keyword . '%';
        $type = Input::get('type');

        $users = $bugs = $posts = $view = null;
        if ($type == 'user') {
            $users = User::where('username', 'like', $keywordPattern)->where('is_admin', '=', false)->paginate(self::PAGE_NUMBER);
            $bugs = Bug::where('name', 'like', $keywordPattern)->limit(10)->get();
            $posts = Post::where('title', 'like', $keywordPattern)->limit(10)->get();
            $view = 'home.search.users';
        } else if ($type == 'post') {
            $posts = Post::where('title', 'like', $keywordPattern)->paginate(self::PAGE_NUMBER);
            $users = User::where('username', 'like', $keywordPattern)->where('is_admin', '=', false)->limit(5)->get();
            $bugs = Bug::where('name', 'like', $keywordPattern)->limit(10)->get();
            $view = 'home.search.posts';
        } else {
            $bugs = Bug::where('name', 'like', $keywordPattern)->paginate(self::PAGE_NUMBER);
            $users = User::where('username', 'like', $keywordPattern)->where('is_admin', '=', false)->limit(5)->get();
            $posts = Post::where('title', 'like', $keywordPattern)->limit(10)->get();
            $view = 'home.search.bugs';
        }

        $sortlist = array('' => '漏洞', 'user' => '用户', 'post' => '帖子');
        $this->layout->title = '搜索|' . $keyword;
        $this->layout->content = View::make($view)->with(array(
            'users' => $users,
            'posts' => $posts,
            'bugs' => $bugs,
            'type' => $type,
            'sortlist' => $sortlist,
            'keyword' => $keyword
        ));
    }

    public function getRanks() {
        $cols = array('bug.id', 'name', 'software', 'os', 'bug.user_id', 'bug.created_at', 'read_count', DB::raw('count(bug_comment.id) as cnt'));
        $bugs = Bug::leftJoin('bug_comment', 'bug.id', '=', 'bug_comment.bug_id')
            ->groupBy('bug.id')
            ->orderBy('cnt', 'desc')
            ->orderBy('read_count', 'desc')
            ->orderBy('bug.created_at', 'desc')
            ->limit(10)
            ->get($cols);

        $cols = array('user.id', 'username',
            DB::raw('count(bug.id) as cnt_bug'),
            DB::raw('count(bbs_post.id) as cnt_post'),
        );
        $users = User::leftJoin('bug', 'bug.user_id', '=', 'user.id')
            ->leftJoin('bbs_post', 'bbs_post.user_id', '=', 'user.id')
            ->groupBy('user.id')
            ->orderBy('cnt_bug', 'desc')
            ->orderBy('cnt_post', 'desc')
            ->where('user.is_admin', '=', false)
            ->limit(10)
            ->get($cols);

        $cols = array(
            'software',
            DB::raw('count(bug.id) as cnt')
        );
        $softwares = DB::table('bug')
            ->groupBy('software')
            ->orderBy('cnt', 'desc')
            ->limit(10)
            ->get($cols);

        $this->layout->title = '排名';
        $this->layout->content = View::make('home.ranks')->with(array(
            'bugs' => $bugs,
            'users' => $users,
            'softwares' => $softwares
        ));
    }
}
