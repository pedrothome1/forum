<?php

namespace App;

use Illuminate\Support\Str;
use App\Filters\ThreadFilters;
use Stevebauman\Purify\Facades\Purify;

class Thread extends Model
{
    use CanBeFavorited;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['user'];

    /**
     * Appends custom accessors in the query result set.
     *
     * @var array
     */
    protected $appends = ['identifier', 'favoritedByUser'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);
        });
    }

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
     * Get the body attribute.
     *
     * @param  $body
     * @return mixed
     */
    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
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

    /**
     * Add a reply to the thread
     *
     * @param  array  $reply
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addReply(array $reply)
    {
        return $this->replies()->create($reply);
    }
}
