<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <title>{{ trans("title.$pageName") }} | roslairy的小窝</title>
    <meta name="keywords" content="博客,个人博客"/>
    <meta name="description" content="这里是roslairy的小窝，记录了一些技术笔记和生活点滴" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/flat-ui.min.css">
    @yield('extCss', '')
    <link rel="stylesheet" href="/css/blog.css">
    <link type="image/x-icon" rel="shortcut icon" href="/img/favicon.ico">
</head>
<body>
<nav class="navbar navbar-default navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('all') }}">roslairy.</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @yield('nav')
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

@yield('header-img', '')

<div class="container main-container">
    @yield('content')
</div>

<div class="footer container-fluid">
    <p class="text-center"><small>Contact me: <span class="text-primary">roslairy@crimro.me</span></small><small>Copyright &copy; 2015 roslairy, All rights reserved.</small></p>
</div>

<!-- scripts -->
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>

@yield('extJs', '')

</body>
</html>