<header class="navbar navbar-inverse navbar-embossed navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">BugTracker</a>
        </div>
        <nav class="collapse navbar-collapse" id="navbar-collapse-01">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="/">主页</a>
                </li>
                <li>
                    <a href="/bug">漏洞</a>
                </li>
                <li>
                    <a href="#">排名</a>
                </li>
                <li>
                    <a href="/bbs">讨论</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="搜索">
                        </div>
                    </form>
                </li>
                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
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
                    <a href="/signin">登陆</a>
                </li>
                <li>
                    <a href="/signup">注册</a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.navbar-collapse -->
    </div>
</header>