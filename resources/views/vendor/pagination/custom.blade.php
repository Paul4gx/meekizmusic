@if ($paginator->hasPages())
    <nav aria-label="shop pagination">
        <ul class="pagination m-lg-t10">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link next"><i class="fa-sharp fa-solid fa-arrow-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link next" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fa-sharp fa-solid fa-arrow-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Three Dots Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item">
                                <a class="page-link active" href="javascript:void(0);"><span>{{ $page }}</span></a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}"><span>{{ $page }}</span></a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link next" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fa-sharp fa-solid fa-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link next"><i class="fa-sharp fa-solid fa-arrow-right"></i></span>
                </li>
            @endif

        </ul>
    </nav>
@endif
