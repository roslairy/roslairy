@extends('manage-base')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form class="blog-archive-block" method="post" action="{{ route('archive-save') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $archive->id }}">
            <div class="h4 block-aside-title"><span>文章编辑</span></div>
            <div class="form-group">
                <label for="title">文章标题</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="标题" value="{{ $archive->title }}">
            </div>
            <div class="form-group">
                <label for="title">文章分类</label>
                <select class="form-control" name="category">
                    <option {{ trans("category.sharpen") == $archive->category ? 'selected' : '' }} value="sharpen">{{ trans("category.sharpen") }}</option>
                    <option {{ trans("category.creation") == $archive->category ? 'selected' : '' }} value="creation">{{ trans("category.creation") }}</option>
                    <option {{ trans("category.anecdote") == $archive->category ? 'selected' : '' }} value="anecdote">{{ trans("category.anecdote") }}</option>
                    <option {{ trans("category.mind") == $archive->category ? 'selected' : '' }} value="mind">{{ trans("category.mind") }}</option>
                </select>
            </div>
            <div class="form-group">
                <label id="umeditor-label" for="umeditor">正文</label>
                <script name="content" id="umeditor" type="text/plain">{!! $archive->content !!}</script>
            </div>
            <button class="btn btn-primary" type="submit">提交</button>
        </form>
    </div>
</div>
@stop

@section('extCss')
<link href="/um/themes/default/css/umeditor.min.css" type="text/css" rel="stylesheet">
@stop

@section('extJs')
<script type="text/javascript" src="/um/umeditor.config.archive.js"></script>
<script type="text/javascript" src="/um/umeditor.min.js"></script>

<script type="text/javascript">
    var um = UM.getEditor('umeditor', {
        initialFrameHeight: 500,
        autoHeightEnabled: true
    });
    $(window).resize(function(){
        this.um.setWidth($('#nickName-wrapper').width());
    });
</script>
@stop