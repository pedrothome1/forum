<?php

namespace App;

use Illuminate\Support\Str;
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
     * Set the slug attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $slug = Str::slug(Str::lower($value));

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
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

    /**
     * A thread belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A thread belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
    * A thread has many replies.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
