<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginatorHelper
{
    public $lengthAwarePaginator;
    public $offset;
    public $request;
    public $before;
    public $after;

    public function __construct(LengthAwarePaginator $lengthAwarePaginator, Request $request, int $offset = 3)
    {
        $this->lengthAwarePaginator = $lengthAwarePaginator;
        $this->request = $request;
        $this->offset = $offset;
    }

    public function getPreviousUrl()
    {
        return $this->lengthAwarePaginator->appends($this->request->all())->url($this->lengthAwarePaginator->currentPage() - 1);
    }

    public function getNextUrl()
    {
        return $this->lengthAwarePaginator->appends($this->request->all())->url($this->lengthAwarePaginator->currentPage() + 1);
    }

    public function getPageUrl($page)
    {
        return $this->lengthAwarePaginator->appends($this->request->all())->url($page);
    }

    public function isVisibleBeforeDots($page)
    {
        $isVisible = $page <= ($this->lengthAwarePaginator->currentPage() - 3) && !$this->before;

        if ($isVisible) {
            $this->before = true;
        }

        return $isVisible;
    }

    public function isVisibleAfterDots($page)
    {
        $isVisible = $page >= ($this->lengthAwarePaginator->currentPage() + 3) && !$this->after;

        if ($isVisible) {
            $this->after = true;
        }

        return $isVisible;
    }

    public function isPageVisible($page)
    {
        return
            1 == $page ||
            2 == $page ||
            $page == $this->lengthAwarePaginator->lastPage() ||
            $page == ($this->lengthAwarePaginator->lastPage() - 1) ||
            ($page > ($this->lengthAwarePaginator->currentPage() - $this->offset) && $page < ($this->lengthAwarePaginator->currentPage() + $this->offset));
    }

    public function isCurrentPage($page)
    {
        return $this->lengthAwarePaginator->currentPage() == $page;
    }
}
