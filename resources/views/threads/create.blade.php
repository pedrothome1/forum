@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-body">
                <form method="POST" action="/threads">
                    @csrf

                    <div class="form-group">
                        <label for="category_id">Assunto:</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="" selected>Escolha um assunto...</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="body">Detalhes do tópico:</label>
                        <textarea name="body" class="form-control" id="body" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <a href="/" class="btn btn-outline-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Publicar
                        </button>
                    </div>
                </form>
            </div>
        </div>


        @if ($anyThread)
            <div class="col-md-4">
                <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
            </div>
        @endif
    </div>
@endsection
