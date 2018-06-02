<div class="card custom-card mb-3">
    <div class="card-header custom-card-header bg-blue-darker text-white text-center">
        Filtros
    </div>

    <ul class="list-group list-group-flush">
        <a href="/" class="list-group-item list-group-item-action">
            <i class="fa fa-globe fa-fw text-blue-darker"></i> Todo os tópicos
        </a>

        @auth
            <a href="/?my=1" class="list-group-item list-group-item-action">
                <i class="fa fa-lightbulb-o fa-fw text-blue-darker"></i> Meus tópicos
            </a>

            <a href="/?participation=1" class="list-group-item list-group-item-action">
                <i class="fa fa-code-fork fa-fw text-blue-darker"></i> Minhas participações
            </a>

            <a href="/?favorite=1" class="list-group-item list-group-item-action">
                <i class="fa fa-star fa-fw text-blue-darker"></i> Meus favoritos
            </a>
        @endauth

        <a href="/?popular=1" class="list-group-item list-group-item-action">
            <i class="fa fa-fire fa-fw text-blue-darker"></i> Mais populares
        </a>

        <a href="/?solved=1" class="list-group-item list-group-item-action">
            <i class="fa fa-fire fa-fw text-blue-darker"></i> Solucionados
        </a>

        <a href="/?unsolved=1" class="list-group-item list-group-item-action">
            <i class="fa fa-lightbulb-o fa-fw text-blue-darker"></i> Não solucionados
        </a>
    </ul>
</div>

<div class="card custom-card">
    <div class="card-header custom-card-header bg-blue-darker text-white text-center">
        Assuntos
    </div>

    <ul class="list-group list-group-flush">
        @foreach ($categories as $category)
            <a href="/{{ $category->slug }}" class="list-group-item list-group-item-action">
                <i class="fa fa-comments-o text-info"></i> {{ $category->name }}
            </a>
        @endforeach
    </ul>
</div>
