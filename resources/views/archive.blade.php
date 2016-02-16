@extends("base")

@section("header-img")
@stop

@section("extCss")
<link rel="stylesheet" href="/css/archive.css">
@stop

@section("body")
<div class="container main-container">
    <div class="row">
        <div class="col-sm-8 col-sm-push-4">
            <article class="article-block">
                <div class="article-wrapper">
                    <h2 class="article-title text-left">{{ $archive->title }}</h2>
                    <h4 class="article-info text-left">{{ $archive->created_at->toDateString() }} <small>{{ trans("category.".$archive->category) }} {{ $archive->like }}个赞</small>
                    @if ($authed)
                    <a class="btn btn-primary btn-xs" href="{{ route("archive-edit", ["id" => $archive->id]) }}">编辑</a>
                    @endif
                    </h4>
                    <div class="article-content">
                        {!! $archive->content !!}
                    </div>
                    <div class="like-wrapper center-block">
                        <button class="btn btn-primary like" data-id="{{ $archive->id }}">赞</button>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-sm-4 col-sm-pull-8">
            <form class="docomment-block" method="post" action="{{ route("send-comment") }}">
                <input type="hidden" name="id" value="{{ $archive->id }}">
                <h3 class="h3-title">发表评论</h3>
                <div class="form-group">
                    <input id="input-nickname" name="nickname" type="text" class="form-control" placeholder="昵称" required>
                </div>
                <div class="form-group">
                    <textarea id="input-comment" name="content" class="form-control" rows="3" placeholder="评论内容" required></textarea>
                </div>
                <button class="btn btn-primary">提交</button>
            </form>
            <div class="comment-block">
                <h3 class="h3-title">评论</h3>
                @foreach($archive->comments as $comment)
                <div class="comment">
                    <h5 class="comment-author">{{ $comment->nickname }} <small class="comment-time">2015-10-31</small></h5>
                    <p>{{ $comment->content }}</p>
                    <button type="button" class="btn btn-primary btn-xs comment-reply" data-author="{{ $comment->nickname }}">回复</button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop
