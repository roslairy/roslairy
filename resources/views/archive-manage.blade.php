@extends('manage-base')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="blog-archive-block">
            <div class="h4 block-aside-title"><span>文章管理</span></div>
            <div class="blog-table table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>#</th>
                    <th>标题</th>
                    <th>分类</th>
                    <th>创建时间</th>
                    <th>修改时间</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($archives as $archive)
                    <tr>
                        <th>{{ $archive->id }}</th>
                        <th title="{{ $archive->title }}">{{ $archive->title }}</th>
                        <th>{{ $archive->category }}</th>
                        <th>{{ $archive->created_at }}</th>
                        <th>{{ $archive->updated_at }}</th>
                        <th>
                            <a class="btn btn-primary btn-xs" href="{{ route('archive-edit', ['id' => $archive->id]) }}">修改</a>
                            <a class="btn btn-danger btn-xs" href="{{ route('archive-delete', ['id' => $archive->id]) }}">删除</a>
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($archives->hasPages())
            @include('paginator', ['paginator' => $archives])
            @endif
        </div>
    </div>
</div>
@stop