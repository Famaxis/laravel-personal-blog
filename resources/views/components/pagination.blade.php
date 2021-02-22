@if ($paginator->hasPages())
    <nav>
        <ul class="pagination inline">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
{{--                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                    <span aria-hidden="true"></span>--}}
{{--                </li>--}}
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='48' d='M328 112L184 256l144 144'/></svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='48' d='M184 112l144 144-144 144'/></svg>
                    </a>
                </li>
            @else
{{--                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span aria-hidden="true"></span>--}}
{{--                </li>--}}
            @endif
        </ul>
    </nav>
@endif
