<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ trans("title.$pageName") }} | roslairy的小窝</title>
    <meta name="keywords" content="博客,个人博客"/>
    <meta name="description" content="这里是roslairy的小窝，记录了一些技术笔记和生活点滴" />
    <link rel="stylesheet" href="/css/admin-bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin-flat-ui.min.css">
    @yield('extCss', '')
    <link rel="stylesheet" href="/css/admin.css">
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
            <a class="navbar-brand" href="/">roslairy.</a>
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

<!-- scripts -->
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>

@yield('extJs', '')

</body>
</html>