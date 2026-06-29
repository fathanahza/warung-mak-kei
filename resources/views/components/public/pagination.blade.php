@if ($paginator->hasPages())
<nav class="flex items-center justify-center gap-1" aria-label="Pagination">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="inline-flex items-center px-3 py-2 text-sm text-gray-300 dark:text-gray-600 bg-gray-50 dark:bg-gray-800 rounded-xl cursor-not-allowed">
            ←
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="inline-flex items-center px-3 py-2 text-sm text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-200 transition">
            ←
        </a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="inline-flex items-center px-3 py-2 text-sm text-gray-400">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-primary-600 rounded-xl">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                       class="inline-flex items-center px-4 py-2 text-sm text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-200 transition">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="inline-flex items-center px-3 py-2 text-sm text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-200 transition">
            →
        </a>
    @else
        <span class="inline-flex items-center px-3 py-2 text-sm text-gray-300 dark:text-gray-600 bg-gray-50 dark:bg-gray-800 rounded-xl cursor-not-allowed">
            →
        </span>
    @endif
</nav>
@endif
