<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filters
{
    /**
     * The current http request.
     *
     * @var Request
     */
    protected $request;

    /**
     * The Eloquent query builder.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * Set of filters to be applied.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Filters constructor.
     *
     * @param  Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters.
     *
     * @param  Builder  $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        if (! $this->any()) {
            return $this->defaultFilter();
        }

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * The default filter to be applied.
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function defaultFilter()
    {
        return $this->builder->latest();
    }

    /**
     * Fetch the filters from the current http request.
     *
     * @return array
     */
    protected function getFilters()
    {
        return $this->request->only($this->filters);
    }

    /**
     * Determine if the request contains any of the given filters.
     *
     * @return bool
     */
    public function any()
    {
        return $this->request->hasAny($this->filters);
    }
}
