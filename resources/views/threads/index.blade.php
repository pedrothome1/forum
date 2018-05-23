@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-hover table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>Tópico</th>
                        <th>Postado em</th>
                        <th>Respostas</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse($threads as $thread)
                        <tr>
                            <td>
                                <a href="{{ $thread->path() }}">{{ str_limit($thread->title, 55) }}</a>
                                <small class="text-muted d-block">Autor: João Antônio</small>
                            </td>
                            <td>20/02/2016 às 12h32</td>
                            <td class="text-center">5</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Não há tópicos para exibir</td>
                        </tr>
                    @endforelse
                    
                    <tr>
                        <td colspan="3">{{ $threads->links() }}</td>
                    </tr>   
                </tbody>
            </table>
        </div>

        @if (count($threads))
            <div class="col-md-4">
                <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
            </div>
        @endif
    </div>
@endsection
