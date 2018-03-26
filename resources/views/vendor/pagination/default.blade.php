@if ($paginator->hasPages())
  <div class="m-t-35">
    <nav class="pagination is-rounded is-centered is-small">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
          <a class="pagination-previous" disabled>&lsaquo;</a>
      @else
          <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous" rel="prev">&lsaquo;&lsaquo;</a>
      @endif

      <ul class="pagination-list">
          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
              {{-- "Three Dots" Separator --}}
              @if (is_string($element))
                  <li><span class="pagination-ellipsis">&hellip;</span></li>
              @endif

              {{-- Array Of Links --}}
              @if (is_array($element))
                  @foreach ($element as $page => $url)
                      @if ($page == $paginator->currentPage())
                          <li>
                            <a class="pagination-link is-current">{{ $page }}</a>
                          </li>
                      @else
                          <li><a href="{{ $url }}" class="pagination-link">{{ $page }}</a></li>
                      @endif
                  @endforeach
              @endif
          @endforeach
      </ul>

          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
              <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" rel="next">&rsaquo;</a>
          @else
              <a class="pagination-next" disabled>&rsaquo;&rsaquo;</a>
          @endif
    </nav>
  </div>

@endif
