@if (session('status'))
    <div class="alert alert-{{ session('class') ?: 'success' }}">
        {{ session('status') }}
    </div>
@endif
