@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @forelse ($threads as $thread)
                <div class="card">
                    <div class="card-header">
                        <a class="font-weight-bold" href="{{ $thread->path() }}">
                            {{ $thread->title }}
                        </a>
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <br>
            @empty
                <div class="alert alert-warning">
                    Não há nenhum tópico criado até o momento.
                </div>
            @endforelse

            {{ $threads->links() }}
        </div>


        @if (count($threads))
            <div class="col-md-4">
                <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
            </div>
        @endif
    </div>
@endsection
