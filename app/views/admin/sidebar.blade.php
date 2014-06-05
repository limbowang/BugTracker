<div class="sidebar dashboard-sidebar">
    <ul class="categories">
        <li class="category">
            {{ HTML::link('/admin/users', '所有用户') }}
        </li>
        <li class="category">
            {{ HTML::link('/admin/bugs', '关于漏洞') }}
        </li>
        <li class="category">
            <ul class="categories">
                <li class="category">
                    {{ HTML::link('/admin/bugs', '所有漏洞') }}
                </li>
                <li class="category">
                    {{ HTML::link('/admin/comments', '所有评论') }}
                </li>
            </ul>
        </li>
        <li class="category">
            {{ HTML::link('/admin/posts', '关于讨论') }}
        </li>
        <li class="category">
            <ul class="categories">
                <li class="category">
                    {{ HTML::link('/admin/posts', '所有帖子') }}
                </li>
                <li class="category">
                    {{ HTML::link('/admin/replies', '所有回复') }}
                </li>
                <li class="category">
                    {{ HTML::link('/admin/topics', '所有话题') }}
                </li>
            </ul>
        </li>
    </ul>
</div>