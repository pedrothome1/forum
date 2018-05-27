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
                            <td class="py-1-5">
                                <a class="text-dark font-weight-bold" href="{{ $thread->path() }}">{{ str_limit($thread->title, 65) }}</a>
                                <small class="text-muted font-weight-bold d-block">
                                    por: <a href="#">{{ $thread->user->username }}</a> &#8226;
                                    <a href="{{ $thread->path() }}" class="text-muted">{{ $thread->created_at->diffForHumans() }}</a>
                                </small>
                            </td>

                            <td class="align-middle">{{ $thread->category->name }}</td>
                            <td class="text-center align-middle">
                                <span class="tag">{{ count($thread->replies) }}</span>
                            </td>
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
