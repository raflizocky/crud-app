{{-- Pagination --}}
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="flex flex-col md:flex-row items-center justify-between pt-4 pb-4" aria-label="Table navigation">
        <div class="w-full md:w-auto mb-4 md:mb-0 text-center md:text-left">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">
                    {{ $paper->firstItem() ?? 0 }}-{{ $paper->lastItem() ?? 0 }}
                </span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">
                    {{ $paper->total() }}
                </span>
            </span>
        </div>

        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            {{-- Previous Page Link --}}
            <li>
                <a href="{{ $paper->previousPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg {{ $paper->onFirstPage() ? 'dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400' : 'hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                    Previous
                </a>
            </li>

            {{-- Pagination Elements --}}
            @php
                $start = max($paper->currentPage() - 1, 1);
                $end = min($start + 2, $paper->lastPage());
                $start = max($end - 2, 1);
            @endphp

            @if ($start > 1)
                <li>
                    <a href="{{ $paper->url(1) }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                </li>
                @if ($start > 2)
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">...</span>
                    </li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                <li>
                    <a href="{{ $paper->url($i) }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight {{ $i == $paper->currentPage() ? 'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor

            @if ($end < $paper->lastPage())
                @if ($end < $paper->lastPage() - 1)
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">...</span>
                    </li>
                @endif
                <li>
                    <a href="{{ $paper->url($paper->lastPage()) }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $paper->lastPage() }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            <li>
                <a href="{{ $paper->nextPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg {{ $paper->hasMorePages() ? 'hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' : 'dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400' }}">
                    Next
                </a>
            </li>
        </ul>
    </nav>
</div>
