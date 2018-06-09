<?php

namespace App;

use Illuminate\Support\Str;

class Category extends Model
{
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($category) {
            $category->update([
                'slug' => Str::slug(Str::lower($category->name))
            ]);
        });
    }

    /**
     * Get the route key for the given category.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * A category has many threads.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
