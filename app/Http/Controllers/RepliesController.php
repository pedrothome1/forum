<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Thread;

class RepliesController extends Controller
{
    public function store(Thread $thread) 
    {
        $this->validate(request(), ['reply-body' => 'required']);

    	Reply::create([
    		'body' => request('reply-body'),
    		'user_id' => auth()->id(),
    		'thread_id' => $thread->id
    	]);

    	return back();
    }
}
