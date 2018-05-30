<?php

namespace App\Http\Controllers;

use App\Thread;

class RepliesController extends Controller
{
    /**
     * Add a reply to a thread.
     *
     * @param  Thread  $thread
     * @return mixed
     */
    public function store(Thread $thread)
    {
        $this->validate(request(), ['reply_body' => 'required']);

        $reply = $thread->addReply([
            'body' => request('reply_body'),
            'user_id' => auth()->id(),
        ]);

        if (request()->expectsJson()) {
            return $reply;
        }

    	return back();
    }
}
