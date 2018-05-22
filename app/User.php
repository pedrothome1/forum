<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

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
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function publish(Thread $thread)
    {
        $thread->slug = Str::slug(Str::lower($thread->title));

        return $this->threads()->save($thread);
    }
}
