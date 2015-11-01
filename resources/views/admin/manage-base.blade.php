@extends('admin.base')

@section('nav')
<ul class="nav navbar-nav">
    <li class="{{ $pageName == 'archive-new' ? 'active' : '' }}"><a href="{{ route('archive-new') }}">写文章</a></li>
    <li class="{{ $pageName == 'archive-manage' ? 'active' : '' }}"><a href="{{ route('archive-manage') }}">文章管理</a></li>
    <li class="{{ $pageName == 'comment-manage' ? 'active' : '' }}"><a href="{{ route('comment-manage') }}">评论管理</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li><a href="{{ route('try-logout') }}">退出</a></li>
</ul>
@stop