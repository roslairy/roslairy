@extends('visit-base')

@section('content')
<div class="row">
    <div class="col-md-9">
    	@foreach($archives as $archive)
        <div class="blog-essay-block">
            <div class="h4 block-essay-title">
            	@if ($archive->category != '朔心' || session('mindPermission') == 'true')
            	<a href="{{ url('archive/'.$archive->id) }}">{{ $archive->title }}</a>
            	@else
            	<a href="#" onclick="$('#read-{{ $archive->id }}').trigger('click'); return false;">{{ $archive->title }}</a>
            	@endif
            </div>
            <div class="blog-essay-info">
	            <small>{{ $archive->created_at->toDateString() }} </small>
	            <small>赞：{{ $archive->like }} </small>
	            <small> 评论：{{ $archive->comments->count() }}</small>
	            <small class="text-primary"> {{ $archive->category }}</small>
	        </div>
            <div class="h5 blog-essay-content">
            	{{ strip_tags($archive->content) }}
            </div>
            @if ($archive->category != '朔心' || session('mindPermission') == 'true')
            <a href="{{ url('archive/'.$archive->id) }}" class="btn btn-primary blog-essay-btn">阅读全文</a>
            @else
            <button id="read-{{ $archive->id }}" type="button" class="btn btn-primary blog-essay-btn" data-toggle="modal" data-target="#pass-modal" data-id="{{ $archive->id }}">阅读全文</button>
            @endif
        </div>
        @endforeach
        @if ($archives->hasPages())
        <div class="blog-paginator">
            <a href="{{ $archives->previousPageUrl() }}" class="btn btn-primary">上一页</a>
            <a href="{{ $archives->nextPageUrl() }}" class="btn btn-primary pull-right">下一页</a>
        </div>
        @endif
    </div>
    <div class="col-md-3">
        <div class="blog-aside-block">
            <div class="h4 block-aside-title"><span>搜索</span></div>
            <form method="get" action="{{ route('search') }}">
            <div class="input-group block-aside-search">
                <input name="search" type="text" class="form-control" placeholder="寻找...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                  </span>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="pass-modal" tabindex="-1" role="dialog">
	<form action="{{ route('try-mind') }}" method="post">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">朔心密码</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input id="pass-id" type="hidden" name="id" value="">
        				<div class="form-group">
						    <input type="password" class="form-control" id="mind-pass" placeholder="密码" name="mind-pass">
						 </div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="submit" class="btn btn-primary">提交</button>
			</div>
		</div>
	</div>
	</form>
</div>
@stop

@section('extJs')
<script type="text/javascript">
	$('#pass-modal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#pass-id').val(button.data('id'));
	});
</script>
@append