<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;

class FavoritesController extends Controller
{
    /**
     * Toggle the favorited state of a thread.
     *
     * @param  Thread  $thread
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toggleThread(Thread $thread)
    {
        return $thread->toggleFavorite();
    }

    /**
     * Toggle the favorited state of a reply.
     *
     * @param  Reply  $reply
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toggleReply(Reply $reply)
    {
        return $reply->toggleFavorite();
    }
}
