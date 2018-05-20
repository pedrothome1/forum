@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @foreach ($threads as $thread)
                <div class="card">
                    <div class="card-header">
                        <a class="font-weight-bold" href="#">{{ $thread->title }}</a>
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <br>
            @endforeach

            {{ $threads->links() }}
        </div>

        <div class="col-md-4">
            <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
        </div>
    </div>
@endsection
