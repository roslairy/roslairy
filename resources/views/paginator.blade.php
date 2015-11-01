
<ul class="pagination hidden-xs">
    <li><a href="{{ $paginator->previousPageUrl() }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a></li>
    @if ($paginator->currentPage() > 1)
    <li><a href="{{ $paginator->url(1) }}">1</a></li>
    @endif
    @if ($paginator->currentPage() > 2)
    <li><span>...</span></li>
    @endif
    <li class="active"><span>{{ $paginator->currentPage() }}</span></li>
    @if ($paginator->currentPage() < $paginator->lastPage() - 1)
    <li><span>...</span></li>
    @endif
    @if ($paginator->currentPage() < $paginator->lastPage())
    <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
    @endif
    <li><a href="{{ $paginator->nextPageUrl() }}"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></li>
</ul>
<div class="visible-xs blog-xs-pagination">
    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
</div>