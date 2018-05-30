@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('threads.form', ['button' => 'Publicar'])
                </div>
            </div>
        </div>

        @if ($anyThread)
            <div class="col-md-4">
                <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
            </div>
        @endif
    </div>
@endsection
