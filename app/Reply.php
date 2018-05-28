<?php

namespace App;

class Reply extends Model
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
    protected $appends = ['identifier'];


    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');

            if ($reply->isBest()) {
                $reply->thread->update(['best_reply_id' => null]);
            }
        });
    }

    /**
     * A reply belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user() 
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * A reply belongs to a thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * Check whether the reply is marked as the best one.
     *
     * @return bool
     */
    public function isBest()
    {
        return $this->thread->best_reply_id == $this->id;
    }
}
