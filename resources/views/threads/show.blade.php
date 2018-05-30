@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $thread->title }}</h4>

                        <small class="text-muted">
                            <span class="text-uppercase">
                                Publicado {{ $thread->created_at->diffForHumans() }}
                                &#8226; por:
                            </span>

                            <a href="#">{{ $thread->user->username }}</a>
                        </small>
                    </div>

                    @auth
                        <favorite-button :model="{{ $thread }}"
                                         icon="star"
                                         :favorited="{{ auth()->user()->hasFavorited($thread) }}">
                        </favorite-button>
                    @endauth
                </div>

                <div class="card-body">
                    {!! $thread->body !!}
                </div>

                @can ('update', $thread)
                    <div class="card-footer thread-footer d-flex justify-content-end">
                        <a href="{{ $thread->path('edit') }}" class="action-link">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </div>
                @endcan
            </div>

            @foreach($replies as $reply)
                <div class="card my-3">
                    <div class="card-body">
                        <div class="mb-0 d-flex justify-content-between align-items-center">
                            <div>
                                <a href="#" class="font-weight-bold">{{ $reply->user->username }}</a>
                                <span class="text-muted"> {{ $reply->created_at->diffForHumans() }}:</span>
                            </div>

                            @auth
                                <favorite-button :model="{{ $reply }}"
                                                 :favorited="{{ auth()->user()->hasFavorited($reply) }}"
                                                 icon="thumbs-up"
                                                 :show-count="true">
                                </favorite-button>
                            @endauth
                        </div>

                        <p class="mb-0">
                            {!! $reply->body !!}
                        </p>
                    </div>

                    {{--<div class="card-footer thread-footer d-flex justify-content-end">--}}
                        {{--<button class="action-link mr-2">--}}
                            {{--<i class="fa fa-trash"></i>--}}
                        {{--</button>--}}

                        {{--<button class="action-link">--}}
                            {{--<i class="fa fa-pencil"></i>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                </div>
            @endforeach

            {{ $replies->links() }}

            @auth
                <form action="/threads/{{ $thread->slug }}/replies" method="POST" class="my-3">
                    @csrf

                    <div class="form-group">
                        <text-editor name="reply_body"
                                     error="{{ $errors->first('reply_body') }}"
                                     placeholder="O que você achou dessa postagem?"></text-editor>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">
                            Responder
                        </button>
                    </div>
                </form>
            @else 
                <div>
                    <p class="text-center my-3">
                        Você precisa estar autenticado para responder: <a href="/login">Entrar</a>
                    </p>
                </div>
            @endauth
        </div>

        <div class="col-md-4">
            <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
        </div>
    </div>
@endsection
