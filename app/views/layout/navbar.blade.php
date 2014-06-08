<header class="navbar navbar-inverse navbar-embossed navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{ HTML::link('/', 'BugTracker', array('class' => 'navbar-brand')) }}
        </div>
        <nav class="collapse navbar-collapse" id="navbar-collapse-01">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    {{ HTML::link('/', '主页') }}
                </li>
                <li>
                    {{ HTML::link('/bug', '漏洞') }}
                </li>
                <li>
                    {{ HTML::link('/ranks', '排名') }}
                </li>
                <li>
                    {{ HTML::link('/bbs', '讨论') }}
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    {{ Form::open(array('url' => '/search', 'class' => 'navbar-form navbar-right', 'role' => 'search', 'method' => 'GET')) }}
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="搜索">
                        </div>
                    {{ Form::close() }}
                </li>
                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ HTML::image(Auth::user()->avatar ? Auth::user()->avatar : '/images/default.jpg', '', array('class'=> 'img-circle')) }}
                        {{ Auth::user()->username }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @if (Auth::user()->isAdmin())
                        <li>{{ HTML::link('admin', '管理') }}</li>
                        <li class="divider"></li>
                        @endif
                        <li>{{ HTML::link('profile', '个人资料') }}</li>
                        <li>{{ HTML::link('security', '安全与密码') }}</li>
                        <li class="divider"></li>
                        <li>{{ HTML::link('mybugs', '我的漏洞') }}</li>
                        <li>{{ HTML::link('comments-received', '收到的评论') }}</li>
                        <li>{{ HTML::link('mycomments', '我的评论') }}</li>
                        <li class="divider"></li>
                        <li>{{ HTML::link('myposts', '我的帖子') }}</li>
                        <li>{{ HTML::link('replies-received', '收到的回复') }}</li>
                        <li>{{ HTML::link('myreplies', '我的回复') }}</li>
                        <li class="divider"></li>
                        <li>{{ HTML::link('logout', '退出') }}</li>
                    </ul>
                </li>
                @else
                <li>
                    {{ HTML::link('/signin', '登陆') }}
                </li>
                <li>
                    {{ HTML::link('/signup', '注册') }}
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.navbar-collapse -->
    </div>
</header>