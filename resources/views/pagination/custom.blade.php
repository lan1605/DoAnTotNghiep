@if ($paginator->hasPages())
<nav class="float-end mt-2" aria-label="Page navigation">
    <ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link" >Trước</a></li>
    @else
        <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">← Trước</a></li>
    @endif
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
        
    @endforeach
    @if ($paginator->hasMorePages())
        <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link">Sau →</a></li>
    @else
        <li class="page-item disabled"><a class="page-link">Sau</a></li>
    @endif
</ul>
</nav>
@endif 
