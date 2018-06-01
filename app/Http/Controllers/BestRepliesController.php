<?php

namespace App\Http\Controllers;

use App\Reply;

class BestRepliesController extends Controller
{
    /**
     * Mark a reply as the best one.
     *
     * @param  Reply  $reply
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Reply $reply)
    {
        $this->authorize('update', $reply->thread);

        $reply->thread->markAsSolved($reply);

        return response([], 204);
    }
}
