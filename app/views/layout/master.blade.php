<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{  $title or 'Home' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- Loading Bootstrap -->
    {{ HTML::style('bootstrap/css/bootstrap.css') }}
    {{ HTML::style('css/flat-ui.css') }}
    {{ HTML::style('css/site.css') }}
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.js') }}
    {{ HTML::script('js/respond.min.js') }}
    <![endif]-->
</head>
<body>

<div class="main">
    @include('layout.navbar')

    @yield('content')

</div>

@include('layout.footer')

{{ HTML::script('js/jquery-1.8.3.min.js') }}
{{ HTML::script('js/jquery-ui-1.10.3.custom.min.js') }}
{{ HTML::script('js/jquery.ui.touch-punch.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/bootstrap-select.js') }}
{{ HTML::script('js/bootstrap-switch.js') }}
{{ HTML::script('js/flatui-checkbox.js') }}
{{ HTML::script('js/flatui-radio.js') }}
{{ HTML::script('js/jquery.tagsinput.js') }}
{{ HTML::script('js/jquery.placeholder.js') }}
{{ HTML::script('js/jquery.stacktable.js') }}
{{ HTML::script('http://vjs.zencdn.net/4.3/video.js') }}
{{ HTML::script('js/application.js') }}
</body>
</html>