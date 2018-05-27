<?php

namespace App;

class Reply extends Model
{
    use CanBeFavorited;

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
