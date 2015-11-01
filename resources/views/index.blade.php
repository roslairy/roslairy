@extends("base")

@section("header-img")
<div id="header-img"></div>
@stop

@section("extCss")
<link rel="stylesheet" href="/css/index.css">
@stop

@section("body")
<div class="logo">
    <div class="container">
        <img class="header-title center-block" src="img/logo.png">
        <img class="header-title center-block" src="img/poem.png">
    </div>
</div>
@include("com-articleList", ["archives" => $archives, "category" => "new", "wannamore" => true])
@stop