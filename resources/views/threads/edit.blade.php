@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-header custom-card-header text-white bg-primary">
                    <i class="fa fa-pencil fa-lg"></i> Editar tópico
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ $thread->path() }}">
                        @method('PATCH')

                        @include('threads.form', ['button' => 'Editar'])
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
