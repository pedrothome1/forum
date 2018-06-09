@csrf

<div class="form-group">
    <label for="name">Nome</label>

    <input type="text"
           name="name"
           id="name"
           class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}"
           value="{{ old('name', $category->name) }}"
           required>

    @if ($errors->has('name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="color">Cor</label>

    <input type="text"
           name="color"
           id="color"
           class="form-control rounded-0{{ $errors->has('color') ? ' is-invalid' : '' }}"
           value="{{ old('color', $category->color) }}"
           required>

    @if ($errors->has('color'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('color') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ $button }}
    </button>
</div>
