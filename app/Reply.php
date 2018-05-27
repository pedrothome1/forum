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
    * A Reply belongs to a User
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function user() 
    {
    	return $this->belongsTo(User::class);
    }
}
