@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())

        @else
            <li class="ll_st cover"><a href="{{ route('shop') }}?page=1"><img src="{{ asset('img/arr-b.svg') }}" alt="" class="fr_mg"><img src="{{ asset('img/arr-b.svg') }}" alt=""></a></li>
            <li class="ll_st_last cover">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><img src="{{ asset('img/arr-b.svg') }}" alt="" class="fr_mg"></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="current_a" aria-current="page"><a>{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="ll_st">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <img src="{{ asset('img/arr-b.svg') }}" alt="">
                </a>
            </li>
            <li class="ll_st_last">
                <a href="{{ route('shop') }}?page={{ $paginator->lastPage() }}">
                    <img src="{{ asset('img/arr-b.svg') }}" alt="" class="fr_mg"><img src="{{ asset('img/arr-b.svg') }}" alt="">
                </a>
            </li>

        @endif
    </ul>

@endif
