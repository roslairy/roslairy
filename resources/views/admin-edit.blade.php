@extends("admin-base")

@section("header-img")
@stop

@section("extCss")
<link rel="stylesheet" href="/css/admin.css">
<link href="/um/themes/default/css/umeditor.min.css" type="text/css" rel="stylesheet">
@stop

@section("body")
<div class="container main-container">
    <div class="row">
        <form class="blog-archive-block outline-box" method="post" enctype="multipart/form-data" action="{{ route("archive-save") }}">
            <a href="#" class="thumbnail picture-preview">
                <img id="picture-preview-img" src="">
            </a>
            <input id="id" type="hidden" name="id" value="{{ $archive->id }}">
            <h3 class="h3-title">文章编辑器</h3>
            <div class="form-group">
                <label for="title">文章标题</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="标题" value="{{ $archive->title }}">
            </div>
            <div class="form-group">
                <label for="category">文章分类</label>
                <select id="category" class="form-control" name="category">
                    <option {{ "sharpen" == $archive->category ? 'selected' : '' }} value="sharpen">{{ trans("category.sharpen") }}</option>
                    <option {{ "anecdote" == $archive->category ? 'selected' : '' }} value="anecdote">{{ trans("category.anecdote") }}</option>
                    <option {{ "mind" == $archive->category ? 'selected' : '' }} value="mind">{{ trans("category.mind") }}</option>
                </select>
            </div>
            <div class="form-group" id="picture-input">
                <label for="picture">推荐图片</label>
                <input name="picture" type="file" class="form-control" id="picture" placeholder="标题" value="">
            </div>
            <div class="checkbox">
                <label>
                    <input name="published" type="checkbox" {{ $archive->published ? "checked" : "" }}> 公开
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="recommended" type="checkbox" {{ $archive->recommended ? "checked" : "" }}> 推荐
                </label>
            </div>
            <div class="form-group">
                <label id="umeditor-label" for="umeditor">正文</label>
                <script name="content" id="umeditor" type="text/plain"></script>
            </div>
            <button class="btn btn-primary" type="submit">提交</button>
        </form>
    </div>
</div>
@stop

@section('extJs')
<script type="text/javascript" src="/um/umeditor.config.archive.js"></script>
<script type="text/javascript" src="/um/umeditor.min.js"></script>
<script type="text/javascript">
    $(function(){
        window.um = UM.getEditor('umeditor', {
            initialFrameHeight: 500,
            autoHeightEnabled: true
        });
        $(window).resize(function(){
            window.um.setWidth($('.blog-archive-block').width());
        });
        window.um.addListener("ready", function(){
            window.um.setWidth($('.blog-archive-block').width());
        });
        setInterval(function(){
            autoSave("{{ route("archive-ajax") }}");
        }, 30000);
    });
</script>
@stop