@if ($paginator->hasPages())
  <div class="kt-pagination  kt-pagination--brand">
    <ul class="kt-pagination__links">
      @if ($paginator->onFirstPage())
        <li class="kt-pagination__link--prev disabled">
          <a><i class="fa fa-angle-left kt-font-brand"></i></a>
        </li>
      @else
        <li class="kt-pagination__link--prev">
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left kt-font-brand"></i></a>
        </li>
      @endif
      @if ($paginator->hasMorePages())
        <li class="kt-pagination__link--next">
          <a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right kt-font-brand"></i></a>
        </li>
      @else
          <li class="kt-pagination__link--next disabled">
            <a><i class="fa fa-angle-left kt-font-brand"></i></a>
          </li>
      @endif

    </ul>
  </div>
@endif
