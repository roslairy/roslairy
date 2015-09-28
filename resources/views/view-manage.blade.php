@extends('manage-base')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="blog-archive-block">
            <div class="h4 block-aside-title"><span>访问管理</span></div>
            <div class="blog-table table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>#</th>
                    <th>IP</th>
                    <th>url</th>
                    <th>访问时间</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($views as $view)
                    <tr>
                        <th>{{ $view->id }}</th>
                        <th>{{ $view->ip }}</th>
                        <th>{{ $view->url }}</th>
                        <th>{{ $view->created_at }}</th>
                        <th>
                            <a href="{{ route('view-delete', ['id' => $view->id]) }}" class="btn btn-danger btn-xs">删除</a>
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($views->hasPages())
            @include('paginator', ['paginator' => $views])
            @endif
        </div>
    </div>
</div>
@stop