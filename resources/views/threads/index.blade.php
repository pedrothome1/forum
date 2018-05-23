@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">

            <table class="table table-bordered">
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
                                <small class="text-muted d-block">por: {{ $thread->user->username }}</small>
                            </td>

                            {{-- Falta formatar a data de criação do post --}}
                            <td>{{ $thread->created_at }}</td> 
                            <td class="text-center">{{ rand(0, 20) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Não há tópicos para exibir</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{ $threads->links() }}
        
        </div>

        @if (count($threads))
            <div class="col-md-4">
                <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
            </div>
        @endif
    </div>
@endsection
