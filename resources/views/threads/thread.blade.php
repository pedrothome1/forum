<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h3>{{ $thread->title }}</h3>

            <small class="text-muted">
                <span class="text-uppercase">
                    Publicado {{ $thread->created_at->diffForHumans() }}
                    &#8226; por:
                </span>

                <a href="#">{{ $thread->user->username }}</a>
            </small>
        </div>

        <favorite-button v-if="app.signedIn" :model="{{ $thread }}" icon="star"></favorite-button>
    </div>

    <div class="card-body">
        {!! $thread->body !!}
    </div>

    <div v-if="! solved && userOwns(thread)" class="card-footer custom-card-footer d-flex justify-content-end">
        <a href="{{ $thread->path('edit') }}" class="action-link">
            <i class="fa fa-pencil"></i>
        </a>
    </div>
</div>
