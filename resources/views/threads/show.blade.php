@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @include('layouts.status')

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $thread->title }}</h4>

                        <small class="text-muted">
                            <span class="text-uppercase">
                                Publicado em {{ $thread->created_at->formatLocalized('%d %B %Y') }}
                                às {{ $thread->created_at->format('H:i') }}
                                &#8226; por:
                            </span>
                            <a href="#">{{ $thread->user->username }}</a>
                        </small>
                    </div>

                    <button class="favorite-link danger">
                        <i class="fa fa-star"></i>
                    </button>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>

            @foreach($replies as $reply)
                <div class="card my-3">
                    <div class="card-body">
                        <div class="mb-0 d-flex justify-content-between align-items-center">
                            <div>
                                <a href="#" class="font-weight-bold">{{ $reply->user->username }}</a>
                                <span class="text-muted"> {{ $reply->created_at->diffForHumans() }}:</span>
                            </div>

                            <button class="favorite-link success">
                                <i class="fa fa-thumbs-up"></i>
                            </button>
                        </div>

                        <p class="mb-0">
                            {{ $reply->body }}
                        </p>
                    </div>
                </div>
            @endforeach

            {{ $replies->links() }}

            @auth
                <form action="/threads/{{ $thread->slug }}/replies" method="POST" class="my-3">
                    @csrf

                    <div class="form-group">
                        <textarea name="reply_body" rows="4" class="form-control {{ $errors->has('reply_body') ? 'is-invalid' : '' }}" placeholder="Sua resposta aqui..."></textarea>

                        @if($errors->has('reply_body'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('reply_body') }}</strong>
                            </span>
                        @endif
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
                        Você precisa estar logado para responder. <a href="/login">Logar-se</a>.
                    </p>
                </div>
            @endauth
        </div>

        <div class="col-md-4">
            <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
        </div>
    </div>
@endsection
