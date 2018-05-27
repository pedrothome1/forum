<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ThreadFilters extends Filters
{
    /**
     * Set of filters to be applied.
     *
     * @var array
     */
    protected $filters = [
        'my',
        'solved',
        'popular',
        'unsolved',
        'favorite',
        'participation',
    ];

    /**
     * Show only the threads created by the authenticated user.
     *
     * @return Builder
     */
    public function my()
    {
        if (auth()->check()) {
            return $this->builder->where('user_id', auth()->id());
        }

        return $this->builder;
    }

    /**
     * Show only the threads that were solved.
     *
     * @return Builder
     */
    public function solved()
    {
        return $this->builder;
    }

    public function popular()
    {

    }

    public function unsolved()
    {

    }

    public function favorite()
    {

    }

    public function participation()
    {

    }
}
