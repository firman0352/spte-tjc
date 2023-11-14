<div class="flex justify-end">
    <nav role="navigation" aria-label="{{ 'Pagination Navigation' }}">
        <ul class="flex space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="{{ 'pagination.previous' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 text-gray-600">
                        @lang('pagination.previous')
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-500 text-white">
                        @lang('pagination.previous')
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-500 text-white">
                        @lang('pagination.next')
                    </a>
                </li>
            @else
                <li aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 text-gray-600">
                        @lang('pagination.next')
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>
