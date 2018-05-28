@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ $thread->path() }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="category_id">Assunto:</label>
                            <select class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" id="category_id">
                                <option value="" selected>Escolha um assunto...</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $thread->category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" value="{{ old('title') ?: $thread->title }}" required>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="body">Detalhes do tópico:</label>
                            <textarea name="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="body" rows="5" required>
                                {{ old('body') ?: trim($thread->body) }}
                            </textarea>

                            @if ($errors->has('body'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <a href="{{ $thread->path() }}" class="btn btn-light">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Editar
                            </button>
                        </div>
                    </form>
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
