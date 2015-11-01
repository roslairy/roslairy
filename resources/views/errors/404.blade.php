@extends("base")

@section("body")
<style type="text/css">
    .error-block{
        padding: 60px 60px;
        background-color: white;
        outline: solid 1px #e7e7e7;
    }
    @media screen and (max-width: 750px){
        .error-block{
            padding: 60px 60px;
            margin-left: -15px;
            margin-right: -15px;
        }
    }
</style>
<div class="container">
    <div class="error-block">
        <h3 class="h3-title">啊哦，找不到啦~</h3>
        <p>页面找不到啦~</p>
    </div>
</div>
<script type="text/javascript" charset="utf-8">setTimeout(function(){location.href='/'}, 3000)</script>
@stop