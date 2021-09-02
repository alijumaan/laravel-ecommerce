<div>
    @if ($paginator->hasPages())
        <nav class="pagination-style mt-30 text-center">
            <ul class="">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <a href="" aria-hidden="true"><i class="ti-angle-left"></i></a>
                    </li>
                @else
                    <li>
                        <a type="button" dusk="previousPage" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">
                            <i class="ti-angle-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><a href="#">{{ $element }}</a></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" wire:key="paginator-page-{{ $page }}" aria-current="page"><a href="#">{{ $page }}</a></li>
                            @else
                                <li class="page-item" wire:key="paginator-page-{{ $page }}"><a type="button" wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a type="button" dusk="nextPage" wire:click="nextPage" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">
                            <i class="ti-angle-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <a href="#"><i class="ti-angle-right"></i></a>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
