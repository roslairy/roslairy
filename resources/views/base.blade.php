<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ isset($pageName) ? ($pageName != "archive" ? trans("title.$pageName") : $archive->title) : "未知页面" }} | Roslairy的小居</title>
    <meta name="keywords" content="博客,个人博客"/>
    <meta name="description" content="这里是roslairy的个人博客，主要记录了一些平时研究的编程技术和自己的生活点滴" />
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/blog.css">
    @yield('extCss', '')
    <link type="image/x-icon" rel="shortcut icon" href="/img/favicon.ico">
</head>
<body>
@yield("header-img", "")
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route("index") }}">roslairy.</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ route("sharpen") }}">利器</a></li>
                <li><a href="{{ route("anecdote") }}">觅梦</a></li>
                <li><a href="{{ route("mind") }}">朔心</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a {!! (isset($authed) && $authed) ? "" : 'id="login-modal-trigger"' !!} href="/admin/archive">自省</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

@yield("body")

<div class="footer container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img class="center-block" src="/img/logo-inverse.png">
                <h3 class="text-center">Roslairy</h3>
            </div>
            <div class="col-sm-4 footer-contact">
                <h3>联系方式</h3>
                <h5>roslairy#hotmail.com</h5>
                <h5 class="text-info">如果有什么想知道的内容，都欢迎联系</h5>
            </div>
            <div class="col-sm-4 footer-frindlink">
                <h3>友情链接</h3>
                <h5 class="text-info">欢迎申请</h5>
            </div>
        </div>
    </div>
    <div class="footer-copy">
        <p class="text-center">Copyright © Roslairy 2015, All rights reserved.</p>
    </div>
</div>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route("try-login") }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">管理登陆</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input-username">用户名：</label>
                                <input type="text" class="form-control" id="input-username" placeholder="用户名" name="username" required="">
                            </div>
                            <div class="form-group">
                                <label for="input-password">密码：</label>
                                <input type="password" class="form-control" id="input-password" placeholder="密码" name="password" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary btn-sm">登陆</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- scripts -->
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/blog.js"></script>
@yield('extJs', '')

</body>
</html>
