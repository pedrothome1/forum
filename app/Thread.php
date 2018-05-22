<?php

namespace App;

use App\Filters\ThreadFilters;

class Thread extends Model
{
    /**
     * Apply the thread filters.
     *
     * @param  $query
     * @param  ThreadFilters  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Get the route key for the given thread.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
