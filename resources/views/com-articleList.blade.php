<div class="container main-container {{ $pageName == "index" ? "shadow-box" : "outline-box" }}">
    <div class="row">
        <div class="sort-title">
            <h2 class="text-center">{{ trans("category.".$category) }}</h2>
        </div>
    </div>
    @for ($i = 0; $i < count($archives); $i++)
    <div class="row">
        <div class="col-sm-6 blog-block-text {{ ($i % 2 == 1) ? "col-sm-push-6" : "" }}">
            @if ($archives[$i]->recommanded)
            <div class="block-star"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></div>
            @endif
            <h2 class="blog-block-title"><a href="{{ route("archive", ['id' => $archives[$i]->id]) }}">{{ $archives[$i]->title }}</a></h2>
            <h4 class="blog-block-author">{{ $archives[$i]->created_at->toDateString() }} <small>{{ trans("category.".$archives[$i]->category) }} {{ $archives[$i]->like }}个赞</small></h4>
            <div class="blog-block-line"></div>
            <p class="blog-block-article">{{ strip_tags($archives[$i]->content) }}</p>
            <a class="btn btn-primary" href="{{ route("archive", ['id' => $archives[$i]->id]) }}">阅读全文</a>
        </div>
        <div class="col-sm-6 blog-block-picture {{ ($i % 2 == 1) ? "col-sm-pull-6" : "" }}" style="background-image: url('uploadimg/{{ $archives[$i]->picture }}')">
        </div>
    </div>
    @endfor
    @if($wannamore)
    <div class="row">
        <a class="wannamore-a" href="{{ route("archive", ["id" => 1]) }}">
            <div class="wannamore">
                <h2 class="text-center">告诉我你想要的</h2>
            </div>
        </a>
    </div>
    @endif
</div>