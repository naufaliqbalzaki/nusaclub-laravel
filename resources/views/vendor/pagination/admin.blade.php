@if ($paginator->hasPages())
    <nav class="admin-pagination-wrapper" role="navigation" aria-label="Pagination Navigation">
        <div class="admin-pagination-info">
            Menampilkan {{ $paginator->firstItem() }} sampai {{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
        </div>

        <div class="admin-pagination-links">
            @if ($paginator->onFirstPage())
                <span class="admin-page-btn disabled">← Sebelumnya</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="admin-page-btn">← Sebelumnya</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="admin-page-dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="admin-page-number active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="admin-page-number">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="admin-page-btn">Berikutnya →</a>
            @else
                <span class="admin-page-btn disabled">Berikutnya →</span>
            @endif
        </div>
    </nav>
@endif