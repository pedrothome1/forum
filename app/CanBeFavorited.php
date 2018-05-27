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
     * A model can be favorited.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }
}
