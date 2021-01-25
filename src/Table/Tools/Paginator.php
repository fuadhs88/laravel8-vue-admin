<?php

namespace Encore\Admin\Table\Tools;

use Encore\Admin\Table;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;

class Paginator extends AbstractTool
{
    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator
     */
    protected $paginator = null;

    /**
     * @var bool
     */
    protected $perPageSelector = true;

    /**
     * Create a new Paginator instance.
     *
     * @param Table $table
     */
    public function __construct(Table $table, $perPageSelector = true)
    {
        $this->table = $table;
        $this->perPageSelector = $perPageSelector;

        $this->initPaginator();
    }

    /**
     * Initialize work for Paginator.
     *
     * @return void
     */
    protected function initPaginator()
    {
        $this->paginator = $this->table->model()->eloquent();

        if ($this->paginator instanceof LengthAwarePaginator) {
            $this->paginator->appends(request()->all());
        }
    }

    /**
     * Get Pagination links.
     *
     * @return array
     */
    protected function paginationLinks()
    {
        $window = UrlWindow::make($this->paginator);

        $elements = array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);

        return [
            'onFirstPage' => $this->paginator->onFirstPage(),
            'previousPageUrl' => $this->paginator->previousPageUrl(),
            'currentPage' => (string)$this->paginator->currentPage(),
            'hasMorePages' => $this->paginator->hasMorePages(),
            'nextPageUrl' => $this->paginator->nextPageUrl(),
            'elements' => $elements,
        ];
//        return $this->paginator->render('admin::table.pagination');
    }

    /**
     * Get per-page selector.
     *
     * @return PerPageSelector
     */
    protected function perPageSelector()
    {
        if (!$this->perPageSelector) {
            return;
        }

        return new PerPageSelector($this->table);
    }

    /**
     *  Get range infomation of paginator.
     *
     * @return array
     */
    protected function paginationRanger()
    {
        $parameters = [
            'first' => $this->paginator->firstItem(),
            'last'  => $this->paginator->lastItem(),
            'total' => $this->paginator->total(),
        ];

        return $parameters;
//        $parameters = collect($parameters)->flatMap(function ($parameter, $key) {
//            return [$key => "<b>$parameter</b>"];
//        });
//
//        return trans('admin.pagination.range', $parameters->all());
    }

    /**
     * Render Paginator.
     *
     * @return array|string
     */
    public function render()
    {
        if (!$this->table->showPagination()) {
            return '';
        }

        return [
            'paginationRanger' => $this->paginationRanger(),
            'paginationLinks' => $this->paginationLinks(),
            'perPageSelector' => $this->perPageSelector()->render(),
        ];
//        return $this->paginationRanger().
//            $this->paginationLinks().
//            $this->perPageSelector();
    }
}
