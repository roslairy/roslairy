@extends('base')

@section('content')
<div class="row">
    <div class="col-md-12 blog-archive-block">
        <div class="alert alert-danger"><strong>啊哦， </strong>{{ $error }}</div>
    </div>
</div>

<script type="text/javascript">
    setTimeout(function(){
        location.href = "/";
    }, 3000);
</script>
@stop