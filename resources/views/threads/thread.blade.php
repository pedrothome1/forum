<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h3>{{ $thread->title }}</h3>

            <small class="text-muted">
                <span class="text-uppercase">
                    Publicado em {{ $thread->created_at->formatLocalized('%d %B %Y') }}
                    ás {{ $thread->created_at->format('H:i') }}
                    &#8226; por:
                </span>

                <a href="{{ route('profiles', $thread->user->username) }}">{{ $thread->user->username }}</a>
            </small>
        </div>

        <favorite-button v-if="app.signedIn" :model="{{ $thread }}" icon="star"></favorite-button>
    </div>

    <div class="card-body">
        {!! $thread->body !!}
    </div>

    @if (optional(Auth::user())->can('update', $thread) || optional(Auth::user())->can('delete', $thread))
        <div class="card-footer custom-card-footer d-flex justify-content-end">
            @can ('update', $thread)
                <a href="{{ $thread->path('edit') }}" class="action-link">
                    <i class="fa fa-pencil"></i>
                </a>
            @endcan

            @can ('delete', $thread)
                <delete-thread form-action="{{ $thread->path() }}"></delete-thread>
            @endcan
        </div>
    @endif
</div>
