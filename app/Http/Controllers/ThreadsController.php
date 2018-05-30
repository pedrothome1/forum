<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Category;
use App\Filters\ThreadFilters;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the threads.
     *
     * @param  ThreadFilters  $filters
     * @param  Category|null  $category
     * @return \Illuminate\Http\Response
     */
    public function index(ThreadFilters $filters, Category $category = null)
    {
        $threads = $this->getThreads($filters, $category);

        return view('threads.index', compact('threads'));
    }

    /**
     * Fetch the threads from the database.
     *
     * @param  ThreadFilters  $filters
     * @param  Category|null  $category
     * @return mixed
     */
    protected function getThreads(ThreadFilters $filters, Category $category = null)
    {
        $threads = Thread::filter($filters);

        if (! is_null($category)) {
            $threads->where('category_id', $category->id);
        }

        return $threads->paginate(10);
    }

    /**
     * Show the form for creating a new thread.
     *
     * @param  Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function create(Thread $thread)
    {
        return view('threads.create', compact('thread'));
    }

    /**
     * Store a newly created thread in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|numeric|exists:categories,id'
        ]);

        $thread = auth()->user()->publish(
            request(['category_id', 'title', 'body'])
        );

        $this->flash('Tópico criado com sucesso.');

        return redirect($thread->path());
    }

    /**
     * Display the specified thread.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        $replies = $thread->replies()->paginate(10);

        return view('threads.show', compact('thread', 'replies'));
    }

    /**
     * Show the form for editing the specified thread.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified thread in storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->validate(request(), [
            'title' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|numeric|exists:categories,id'
        ]);

        $thread->update([
            'title' => request('title'),
            'body' => request('body'),
            'category_id' => request('category_id'),
            'slug' => request('title')
        ]);

        $this->flash('Tópico atualizado com sucesso.');

        return redirect($thread->path());
    }

    /**
     * Remove the specified thread from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);

        $thread->delete();

        $this->flash('Tópico excluído com sucesso.');

        return redirect()->home();
    }
}
