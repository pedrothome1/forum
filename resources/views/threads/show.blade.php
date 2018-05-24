@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @include('layouts.status')

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
            
            <div class="card my-3">
                <div class="card-body">
                    <p><span class="font-weight-bold">JuvenalAntena99</span><span class="text-muted"> (há 10 minutos atrás):</span> </p>
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi architecto totam possimus voluptatum nulla, neque repudiandae iure dolorum laborum aut sed tempore, veniam nihil commodi cumque hic. A, ipsam, amet.</p>
                </div>
            </div>
    
            @auth
                <form>
                    <div class="form-group">
                        <textarea name="" id="" rows="4" class="form-control" placeholder="Sua resposta aqui..."></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-info">Responder</button>
                    </div>
                </form>
            @else 
                <div>
                    <p class="text-center">Você precisa estar logado para responder. <a href="{{ url('/login') }}">Logar-se</a>.</p>
                </div>
            @endauth
        </div>

        <div class="col-md-4">
            <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
        </div>
    </div>
@endsection
