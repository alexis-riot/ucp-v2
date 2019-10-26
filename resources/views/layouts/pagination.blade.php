@if ($paginator->hasPages())
  <div class="kt-pagination  kt-pagination--brand">
        <ul class="kt-pagination__links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="kt-pagination__link--first disabled">
                  <a><i class="fa fa-angle-double-left kt-font-brand"></i></a>
                </li>
                <li class="kt-pagination__link--next disabled">
                  <a><i class="fa fa-angle-left kt-font-brand"></i></a>
                </li>
            @else
                <li class="kt-pagination__link--first">
                  <a href="{{ url()->current() }}"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
                </li>
                <li class="kt-pagination__link--next">
                  <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left kt-font-brand"></i></a>
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
                            <li class="kt-pagination__link--active">
                              <a href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li>
                              <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="kt-pagination__link--prev">
                  <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right kt-font-brand"></i></a>
                </li>
                <li class="kt-pagination__link--last">
                  <a href="{{ $paginator->url($paginator->lastPage()) }}"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
                </li>
            @else
              <li class="kt-pagination__link--prev disabled">
                <a><i class="fa fa-angle-right kt-font-brand"></i></a>
              </li>
              <li class="kt-pagination__link--last disabled">
                <a><i class="fa fa-angle-double-right kt-font-brand"></i></a>
              </li>
            @endif
        </ul>
  </div>
@endif
