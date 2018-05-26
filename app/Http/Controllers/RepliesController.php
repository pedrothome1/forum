<?php

namespace App\Http\Controllers;

use App\Thread;

class RepliesController extends Controller
{
    /**
     * Add a reply to a thread.
     *
     * @param  Thread  $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Thread $thread)
    {
        $this->validate(request(), ['reply_body' => 'required']);

        $thread->replies()->create([
            'body' => request('reply_body'),
            'user_id' => auth()->id(),
        ]);

    	return back();
    }
}
