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
    protected $fillable = ['name', 'email', 'username', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['email', 'password', 'remember_token'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['is_admin' => 'boolean'];

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
     * @param  array  $thread
     * @return mixed
     */
    public function publish(array $thread)
    {
        return $this->threads()->create($thread);
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
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

    /**
     * Check whether the user is an administrator.
     *
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * A user has many replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
