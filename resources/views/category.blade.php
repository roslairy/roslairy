@extends("base")

@section("extCss")
    <link rel="stylesheet" href="/css/list.css">
@stop

@section("header-img")
<div id=""></div>
@stop

@section("body")
@include("com-articleList", ["archives" => $archives, "category" => $category, "wannamore" => false])
@stop