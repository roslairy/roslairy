@extends('base')

@section('nav')
<ul class="nav navbar-nav">
    <li class="{{ $pageName == 'archive-new' ? 'active' : '' }}"><a href="{{ route('archive-new') }}">写文章</a></li>
    <li class="{{ $pageName == 'archive-manage' ? 'active' : '' }}"><a href="{{ route('archive-manage') }}">文章管理</a></li>
    <li class="{{ $pageName == 'comment-manage' ? 'active' : '' }}"><a href="{{ route('comment-manage') }}">评论管理</a></li>
    @if ($superAuth)
    <li class="{{ $pageName == 'view-manage' ? 'active' : '' }}"><a href="{{ route('view-manage') }}">访问管理</a></li>
    @endif
</ul>
<ul class="nav navbar-nav navbar-right">
    <li><a href="{{ route('try-logout') }}">退出</a></li>
</ul>
@stop