<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;

class RepliesController extends Controller
{
    /**
     * Return the replies of the given thread.
     *
     * @param  Thread  $thread
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Thread $thread)
    {
        return $thread->replies()->paginate(10);
    }

    /**
     * Add a reply to a thread.
     *
     * @param  Thread  $thread
     * @return mixed
     */
    public function store(Thread $thread)
    {
        $this->validate(request(), ['reply_body' => 'required']);

        $reply = $thread->addReply(['body' => request('reply_body')]);

        if (request()->expectsJson()) {
            return $reply->load('user');
        }

    	return back();
    }

    /**
     * Update the given reply.
     *
     * @param  Reply  $reply
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $this->validate(request(), ['body' => 'required']);

        return tap($reply)->update(request(['body']));
    }

    /**
     * Remove the given reply from the database.
     *
     * @param  Reply  $reply
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        return tap($reply)->delete();
    }
}
