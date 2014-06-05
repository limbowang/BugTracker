<div class="sidebar dashboard-sidebar">
    <ul class="categories">
        <li class="category">
            {{ HTML::link('/profile', '个人资料') }}
        </li>
        <li class="category">
            {{ HTML::link('/security', '安全与密码') }}
        </li>
        <li class="category">
            {{ HTML::link('/mybugs', '关于漏洞') }}
        </li>
        <li class="category">
            <ul class="categories">
                <li class="category">
                    {{ HTML::link('/mybugs', '我的漏洞') }}
                </li>
                <li class="category">
                    {{ HTML::link('/comments-received', '收到的评论') }}
                </li>
                <li class="category">
                    {{ HTML::link('/mycomments', '我的评论') }}
                </li>
            </ul>
        </li>
        <li class="category">
            {{ HTML::link('/myposts', '关于讨论') }}
        </li>
        <li class="category">
            <ul class="categories">
                <li class="category">
                    {{ HTML::link('/myposts', '我的帖子') }}
                </li>
                <li class="category">
                    {{ HTML::link('/replies-received', '收到的回复') }}
                </li>
                <li class="category">
                    {{ HTML::link('/myreplies', '我的回复') }}
                </li>
            </ul>
        </li>
    </ul>
</div>