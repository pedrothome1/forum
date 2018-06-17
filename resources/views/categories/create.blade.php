@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-header custom-card-header text-white bg-primary">
                    <i class="fa fa-pencil fa-lg"></i> Nova categoria
                </div>

                <div class="card-body">
                    <form method="POST" action="/admin/categories">
                        @include('categories.form', ['button' => 'Criar'])
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @include('categories.actions')
        </div>
    </div>
@endsection
