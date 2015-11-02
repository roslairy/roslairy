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
                    <tr><th>#</th>
                        <th>标题</th>
                        <th>发布</th>
                        <th>推荐</th>
                        <th>分类</th>
                        <th>创建时间</th>
                        <th>修改时间</th>
                        <th>操作</th>
                    </tr></thead>
                    <tbody>
                    @foreach($archives as $archive)
                    <tr>
                        <th>{{ $archive->id }}</th>
                        <th title="{{ $archive->title }}">{{ $archive->title }}</th>
                        <th>{{ $archive->published ? "是" : "否" }}</th>
                        <th>{{ $archive->recommended ? "是" : "否" }}</th>
                        <th>{{ trans("category.".$archive->category) }}</th>
                        <th>{{ $archive->created_at }}</th>
                        <th>{{ $archive->updated_at }}</th>
                        <th>
                            <a class="btn btn-success btn-xs" href="{{ route('archive', ['id' => $archive->id]) }}">查看</a>
                            <a class="btn btn-primary btn-xs" href="{{ route('archive-edit', ['id' => $archive->id]) }}">修改</a>
                            <a class="btn btn-danger btn-xs" href="{{ route('archive-delete', ['id' => $archive->id]) }}">删除</a>
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($archives->hasPages())
            @include('paginator', ['paginator' => $archives])
            @endif
        </div>
    </div>
</div>
@stop