@extends('layouts.app')

@section('content')
    <div class="card border-0">
        <div class="card-header custom-card-header bg-primary text-white">
            <i class="fa fa-user fa-lg"></i> Perfil
        </div>

        <div class="card-body p-0">
            <div class="jumbotron jumbotron-fluid bg-white py-0">
                <div class="container">
                    <div class="mt-4 pt-2">
                        <div class="d-flex align-items-baseline flex-sm-column flex-md-column flex-lg-row">
                            <h2 class="font-weight-600">{{ $user->name }}</h2>

                            <span class="text-muted mx-1">({{ $user->username }})</span>
                        </div>

                        <div class="row pt-2 pb-3">
                            <div class="col-md-4 py-1 py-md-0">
                                <div class="lead text-secondary">
                                    Membro desde <span class="text-info">{{ $user->created_at->formatLocalized('%d de %B de %Y') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4 text-md-center py-1 py-md-0">
                                <div class="lead text-secondary">
                                    Criou <span class="text-info">{{ count($user->threads) }}</span>
                                    {{ count($user->threads) === 1 ? "discussão" : "discussões" }}
                                </div>
                            </div>

                            <div class="col-md-4 text-md-right py-1 py-md-0">
                                <div class="lead text-secondary">
                                    Respondeu a <span class="text-info">{{ count($user->replies) }}</span>
                                    {{ count($user->replies) === 1 ? "tópico" : "tópicos"}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="pt-4">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="threads-tab" data-toggle="tab" href="#threads" role="tab" aria-controls="threads" aria-selected="true">Tópicos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#replies" role="tab" aria-controls="replies" aria-selected="false">Respostas</a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="threads" role="tabpanel" aria-labelledby="threads-tab">
                            <div class="mt-3">
                                @if (count($user->threads))
                                    <h4 class="lead">Últimos tópicos: </h4>

                                    <ul>
                                        @foreach ($user->threads->take(20)->reverse() as $thread)
                                            <li class="text-secondary my-3">
                                                Criou o tópico
                                                "<a href="{{ $thread->path() }}">{{ str_limit($thread->title, 100) }}</a>"
                                                &#8226; {{ $thread->created_at->diffForHumans() }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="lead text-center mt-5">
                                        {{ Auth::user()->id === $user->id ? "Você" : "Este usuário" }} ainda não criou nenhum tópico
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="replies" role="tabpanel" aria-labelledby="replies-tab">
                            <div class="mt-3">
                                @if (count($user->replies))
                                    <h4 class="lead">Últimas repostas: </h4>

                                    <ul>
                                        @foreach ($user->replies->take(20)->reverse() as $reply)
                                            <li class="text-secondary my-3">
                                                Respondeu ao tópico
                                                "<a href="{{ $reply->thread->path() }}">{{ str_limit($reply->thread->title, 100) }}</a>"
                                                &#8226; {{ $reply->created_at->diffForHumans() }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="lead text-center mt-5">
                                        {{ Auth::user()->id === $user->id ? "Você" : "Este usuário" }} ainda não respondeu a nenhum tópico
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
