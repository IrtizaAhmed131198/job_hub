@if ($paginator->hasPages())
    <div class="paginations">
        <ul class="pager">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span class="pager-prev"></span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" class="pager-prev"></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pager-number active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="pager-number">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" class="pager-next"></a></li>
            @else
                <li class="disabled"><span class="pager-next"></span></li>
            @endif
        </ul>
    </div>
@endif
