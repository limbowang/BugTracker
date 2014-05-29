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
                        <li>{{ HTML::link('#', '个人信息') }}</li>
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