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
                    <div class="card-footer custom-card-footer d-flex justify-content-end">
                        <a href="{{ $thread->path('edit') }}" class="action-link">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </div>
                @endcan
            </div>

            <div>
                <replies></replies>
            </div>
        </div>

        <div class="col-md-4">
            <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
        </div>
    </div>
@endsection
