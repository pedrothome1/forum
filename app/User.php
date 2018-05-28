<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'name',
        'password',
        'created_at',
        'updated_at',
        'remember_token',
    ];

    /**
     * A user has many threads.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Publish a thread.
     *
     * @param  Thread  $thread
     * @return mixed
     */
    public function publish(Thread $thread)
    {
        return $this->threads()->save($thread);
    }

    /**
     * Check whether the user has favorited the given model.
     *
     * @param  object  $favorited
     * @return int
     */
    public function hasFavorited($favorited)
    {
        if (! is_object($favorited)) {
            return false;
        }

        return Favorite::where('user_id', $this->id)
            ->where('favorited_id', $favorited->id)
            ->where('favorited_type', get_class($favorited))
            ->count();
    }

    /**
     * Determine if the user owns the given model.
     *
     * @param  object  $model
     * @return bool
     */
    public function owns($model)
    {
        return $this->id == optional($model)->user_id;
    }
}
