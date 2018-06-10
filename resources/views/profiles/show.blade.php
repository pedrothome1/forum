@extends('layouts.app')

@section('content')
	<div class="mx-auto">
		<div class="card">
			<div class="card-header bg-primary text-light text-uppercase">
				Perfil de usuário
			</div>
			<div class="card-body p-0">
				<div class="jumbotron jumbotron-fluid bg-white py-0">
					<div class="container">
						<div class="mt-5">
							<div class="d-flex align-items-baseline flex-sm-column flex-md-column flex-lg-row">
								<h1 class="display-4">{{ $user->name }}</h1>
								<span class="text-muted mx-1">({{ $user->username }})</span>
							</div>

							<div class="d-flex justify-content-between flex-sm-column flex-md-row pt-2 pb-3">
								<div class="lead text-secondary">
									Membro desde <span class="text-info">{{ $user->created_at->formatLocalized('%d de %B de %Y') }}</span>
								</div>
								<div class="lead text-secondary">
									Criou <span class="text-info">{{ count($user->threads) }}</span> 
									{{ count($user->threads) === 1 ? "discussão" : "discussões" }}
								</div>
								<div class="lead text-secondary">
									Respondeu a <span class="text-info">{{ count($user->replies) }}</span> 
									{{ count($user->replies) === 1 ? "tópico" : "tópicos"}}
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
									@if(count($user->threads))
										<h4 class="lead">Últimos 20 tópicos: </h4>

										<ul>
											@foreach($user->threads->take(20)->reverse() as $thread)
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
									@if(count($user->replies))
										<h4 class="lead">Últimas 20 repostas: </h4>

										<ul>
											@foreach($user->replies->take(20)->reverse() as $reply)
												<li class="text-secondary my-3">
													Respondeu ao tópico 
													"<a href="{{ $reply->thread->path() }}">{{ str_limit($reply->thread->title, 100) }}</a>" 
													&#8226; {{ $reply->created_at->diffForHumans() }}
												</li>
											@endforeach
										</ul>
									@else 
										<div class="lead text-center mt-5">
											{{ @Auth::user()->id === $user->id ? "Você" : "Este usuário" }} ainda não respondeu a nenhum tópico
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection