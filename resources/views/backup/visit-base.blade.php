@extends('base')

@section('nav')
<ul class="nav navbar-nav">
    <li class="{{ $pageName == 'all' ? 'active' : '' }}" id="all"><a href="{{ route('all') }}">纵览</a></li>
    <li class="{{ $pageName == 'sharpen' ? 'active' : '' }}" id="sharpen"><a href="{{ route('sharpen') }}">利器</a></li>
    <li class="{{ $pageName == 'creation' ? 'active' : '' }}" id="creation"><a href="{{ route('creation') }}">造梦</a></li>
    <li class="{{ $pageName == 'anecdote' ? 'active' : '' }}" id="anecdote"><a href="{{ route('anecdote') }}">轶事</a></li>
    <li class="{{ $pageName == 'mind' ? 'active' : '' }}" id="mind"><a href="{{ route('mind') }}">朔心</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li>
    	@if(session('login', 'false') == 'true')
    	<a href="{{ route('archive-manage') }}">自省</a>
    	@else
    	<a href="#" onclick="$('#login-modal').modal();return false;">自省</a>
    	@endif
    </li>
</ul>
@stop

@section('header-img')
<div class="header-img">
    <div class="container">
        <img class="header-title" src="/img/title.png">
    </div>
</div>
@stop

@section('content')
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('try-login') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">管理登陆</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
	        				<div class="form-group">
	        					<label for="username">用户名：</label>
							    <input type="password" class="form-control" id="username" placeholder="用户名" name="username" required>
							</div>
	        				<div class="form-group">
	        					<label for="password">密码：</label>
							    <input type="password" class="form-control" id="password" placeholder="密码" name="password" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">取消</button>
					<button type="submit" class="btn btn-primary btn-sm">登陆</button>
				</div>
			</form>
		</div>
	</div>
</div>
@append