<form method="POST" action="{{ $thread->exists ? $thread->path() : '/threads' }}">
    @csrf

    @if ($thread->exists)
        @method('PATCH')
    @endif

    <div class="form-group">
        <label for="category_id">Assunto:</label>

        <select class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" id="category_id" required>
            <option value="" selected>Escolha um assunto...</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == (old('category_id') ?: $thread->id) ? 'selected' : '' }}>
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
        <label>Detalhes do tópico:</label>

        <text-editor name="body" value="{{ old('body') ?: $thread->body }}" error="{{ $errors->first('body') }}"></text-editor>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            {{ $button }}
        </button>

        <a href="{{ $thread->exists ? $thread->path() : '/' }}" class="btn btn-light">
            Cancelar
        </a>
    </div>
</form>