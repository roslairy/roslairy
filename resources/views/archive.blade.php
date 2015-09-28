@extends('visit-base')

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="blog-archive-block">
            <div class="blog-archive-title text-center h4">{{ $archive->title }}</div>
            <div class="blog-archive-info text-center small">{{ $archive->created_at }}</div>
            <article class="blog-archive-content">
                {!! $archive->content !!}
            </article>
            <div class="blog-archive-like center-block">
                <a class="btn btn-primary">赞 <span class="badge"> {{ $archive->like }}</span> </a>
            </div>
        </div>
        <div class="blog-archive-block">
            <div class="h4 block-aside-title"><span>评论</span></div>
            @foreach($archive->comments as $comment)
            <div class="blog-comment-block">
                <p class="blog-comment-speaker">{{ $comment->nickname }}:</p>
                <p class="blog-comment-content">{{ $comment->content }}</p>
            </div>
            @endforeach
            <div class="h4 block-aside-title"><span>发表评论</span></div>
            <form class="blog-comment-block" action="" method="post">
                <div class="form-group" id="nickName-wrapper">
                    <label for="nickName">昵称： <small class="text-info">昵称可以随便输入</small></label>
                    <input type="text" class="form-control" id="nickName" placeholder="名称" required>
                </div>
                <script id="umeditor" name="content"></script>
                <button type="submit" class="btn btn-primary blog-comment-submit">提交</button>
            </form>
        </div>
    </div>
    <div class="col-md-3">
        <div class="blog-aside-block">
            <div class="h4 block-aside-title"><span>搜索</span></div>
            <div class="input-group block-aside-search">
                <input type="text" class="form-control" placeholder="寻找...">
                <span class="input-group-btn">
                    <a class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                </span>
            </div>
        </div>
    </div>
</div>
@stop