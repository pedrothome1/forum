@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('threads.form', ['button' => 'Editar'])
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
