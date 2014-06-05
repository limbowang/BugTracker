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
    }
}
