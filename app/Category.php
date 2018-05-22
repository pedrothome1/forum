<?php

namespace App;

class Category extends Model
{
    /**
     * Get the route key for the given category.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
