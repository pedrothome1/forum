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
        </div>

        <div class="col-md-4">
            <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
        </div>
    </div>
@endsection
