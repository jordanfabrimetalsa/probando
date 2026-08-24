@if ($paginator->hasPages())
    <nav class="news-pager" aria-label="Paginación de noticias">
        @if ($paginator->onFirstPage())
            <span class="news-pager__control is-disabled" aria-disabled="true"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i><span>Anterior</span></span>
        @else
            <a class="news-pager__control" href="{{ $paginator->previousPageUrl() }}" rel="prev" data-no-loading><i class="fa-solid fa-arrow-left" aria-hidden="true"></i><span>Anterior</span></a>
        @endif

        <div class="news-pager__pages" aria-label="Páginas">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="news-pager__ellipsis" aria-hidden="true">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="news-pager__page is-current" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="news-pager__page" href="{{ $url }}" aria-label="Ir a la página {{ $page }}" data-no-loading>{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a class="news-pager__control" href="{{ $paginator->nextPageUrl() }}" rel="next" data-no-loading><span>Siguiente</span><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        @else
            <span class="news-pager__control is-disabled" aria-disabled="true"><span>Siguiente</span><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
        @endif
    </nav>
@endif
