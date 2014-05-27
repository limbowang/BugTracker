<div class="pagination">
    <ul>
        <li class="previous">
            @if ($page <= 1)
            {{ HTML::link('#', '', array('class' => 'fui-arrow-left')) }}
            @else
            {{ HTML::link('?p=' + $page - 1, '', array('class' => 'fui-arrow-left')) }}
            @endif
        </li>
        @if ($total < 8)

        @else
        @endif
        <li class="next">
            @if ($page >= $total)
            {{ HTML::link('#', '', array('class' => 'fui-arrow-right')) }}
            @else
            {{ HTML::link('?p=' + $page + 1, '', array('class' => 'fui-arrow-right')) }}
            @endif
        </li>

<!--        <li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>-->
<!--        <li class="active"><a href="#fakelink">1</a></li>-->
<!--        <li><a href="#fakelink">2</a></li>-->
<!--        <li><a href="#fakelink">3</a></li>-->
<!--        <li><a href="#fakelink">4</a></li>-->
<!--        <li><a href="#fakelink">5</a></li>-->
<!--        <li><a href="#fakelink">6</a></li>-->
<!--        <li><a href="#fakelink">7</a></li>-->
<!--        <li><a href="#fakelink">8</a></li>-->
<!--        <li><a href="#fakelink">9</a></li>-->
<!--        <li><a href="#fakelink">10</a></li>-->
<!--        <li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>-->
    </ul>
</div>