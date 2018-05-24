@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">

            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>Tópico</th>
                        <th class="text-center">Assunto</th>
                        <th class="text-center">Respostas</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse($threads as $thread)
                        <tr>
                            <td>
                                <a href="{{ $thread->path() }}">{{ str_limit($thread->title, 65) }}</a>
                                <small class="text-muted d-block">
                                    por: <strong>{{ $thread->user->username }}</strong> &#8226; {{ $thread->created_at->diffForHumans() }}
                                </small>
                            </td>

                            <td class="align-middle">{{ $thread->category->name }}</td>
                            <td class="text-center align-middle">{{ rand(0, 20) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Não há tópicos para exibir</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $threads->links('vendor.pagination.bootstrap-4') }}
            
        </div>

        @if ($anyThread)
            <div class="col-md-4">
                <filters-sidebar :categories="{{ $categories }}"></filters-sidebar>
            </div>
        @endif
    </div>
@endsection
