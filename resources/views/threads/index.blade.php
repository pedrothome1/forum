@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white">Tópico</th>
                        <th class="text-center text-white">Assunto</th>
                        <th class="text-center text-white">Respostas</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse($threads as $thread)
                        <tr>
                            <td class="py-1-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <a class="text-dark font-weight-bold" href="{{ $thread->path() }}">{{ str_limit($thread->title, 65) }}</a>
                                        <small class="text-muted font-weight-bold d-block">
                                            por: <a href="#">{{ $thread->user->username }}</a> &#8226;
                                            <a href="{{ $thread->path() }}" class="text-muted">{{ $thread->created_at->diffForHumans() }}</a>
                                        </small>
                                    </div>

                                    @if ($thread->solved)
                                        <div>
                                            <i class="fa fa-check fa-lg text-success"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="align-middle text-center">{{ $thread->category->name }}</td>
                            <td class="text-center align-middle">
                                <span class="badge badge-pill badge-success my-badge">{{ count($thread->replies) }}</span>
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

        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
