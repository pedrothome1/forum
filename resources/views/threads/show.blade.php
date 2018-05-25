@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @include('layouts.status')
            
            {{-- THREAD --}}
            <div class="card">
                <div class="card-header">
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

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            
            {{-- RELPLY --}}
            @foreach($thread->replies as $reply)
                <div class="card my-3">
                    <div class="card-body">
                        <p class="mb-0">
                            <span class="font-weight-bold">{{ $reply->user->username }}</span>
                            <span class="text-muted"> ({{ $reply->created_at->diffForHumans() }}): </span> 
                        </p>
                        <p class="mb-0">
                            {{ $reply->body }}
                        </p>
                    </div>
                </div>
            @endforeach
            
            {{-- FORM TO REPLY --}}
            @auth
                <form action="/threads/{{ $thread->slug }}/replie" method="POST" class="my-3">

                    @csrf

                    <div class="form-group">
                        <textarea name="reply-body" rows="4" class="form-control {{ $errors->has('reply-body') ? 'is-invalid' : '' }}" placeholder="Sua resposta aqui..."></textarea>

                        @if($errors->has('reply-body'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('reply-body') }}</strong>
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
                        Você precisa estar logado para responder. <a href="{{ url('/login') }}">Logar-se</a>.
                    </p>
                </div>
            @endauth
        </div>

        <div class="col-md-4">
            <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
        </div>
    </div>
@endsection
