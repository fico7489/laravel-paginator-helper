# Laravel paginator helper

## Example

```
<?php $paginatorHelper = new \App\Services\PaginatorHelper($models, request()); ?>

<nav class="d-inline-block">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link"
               href="{{ $paginatorHelper->getPreviousUrl() }}"
               style="width: 9rem; @if($models->onFirstPage()) pointer-events: none;cursor: default; opacity: 0.5; @endif ">
                Previous
            </a>
        </li>
        @for ($page = 1; $page <= $models->lastPage(); $page++)
            @if($paginatorHelper->isPageVisible($page))
                <li class="page-item @if($paginatorHelper->isCurrentPage($page)) active @endif">
                    <a class="page-link" href="{{ $paginatorHelper->getPageUrl($page) }}">{{ $page }}</a>
                </li>
            @else
                @if($paginatorHelper->isVisibleBeforeDots($page))
                    <li class="page-item"><a class="page-link disabled">...</a></li>
                @endif
                @if($paginatorHelper->isVisibleAfterDots($page))
                    <li class="page-item"><a class="page-link disabled">...</a></li>
                @endif
            @endif
        @endfor
        <li class="page-item">
            <a class="page-link"
               href="{{ $paginatorHelper->getNextUrl() }}"
               style="width: 9rem; @if(!$models->hasMorePages()) pointer-events: none;cursor: default; opacity: 0.5; @endif ">
                Next
            </a>
        </li>
    </ul>
</nav>
```

