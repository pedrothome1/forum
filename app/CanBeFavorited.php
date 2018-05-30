<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait CanBeFavorited
{
    /**
     * Boot the trait.
     */
    protected static function bootCanBeFavorited()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });

        static::addGlobalScope('favorites-count', function (Builder $query) {
            return $query->withCount('favorites');
        });
    }

    /**
     * Toggle favorite.
     *
     * @return Model
     */
    public function toggleFavorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }

        return $this->favorites()->where($attributes)->get()->each->delete();
    }

    /**
     * Check whether the model has been favorited by the authenticated user.
     *
     * @return int
     */
    public function getFavoritedByUserAttribute()
    {
        return auth()->check() ? (int) $this->favoritedByUser() : 0;
    }

    /**
     * Check whether the model has been favorited by the given user.
     *
     * @param  User|null  $user
     * @return bool
     */
    public function favoritedByUser(User $user = null)
    {
        $user = $user ?: auth()->user();

        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    /**
     * A model can be favorited.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }
}
