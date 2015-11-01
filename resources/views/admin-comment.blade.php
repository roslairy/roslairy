@extends("admin-base")

@section("header-img")
@stop

@section("extCss")
<link rel="stylesheet" href="/css/admin.css">
@stop

@section("body")
<div class="container main-container">
    <div class="row">
        <div class="blog-archive-block outline-box">
            <h3 class="h3-title">文章编辑器</h3>
            <div class="blog-table table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>#</th>
                    <th>文章</th>
                    <th>昵称</th>
                    <th>内容</th>
                    <th>发布时间</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <th>{{ $comment->id }}</th>
                        <th>{{ $comment->archive->title }}</th>
                        <th>{{ $comment->nickname }}</th>
                        <th>{{ strip_tags($comment->content) }}</th>
                        <th>{{ $comment->created_at }}</th>
                        <th>
                            <a href="{{ route('comment-delete', ['id' => $comment->id]) }}" class="btn btn-danger btn-xs">删除</a>
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($comments->hasPages())
            @include('paginator', ['paginator' => $comments])
            @endif
        </div>
    </div>
</div>
@stop