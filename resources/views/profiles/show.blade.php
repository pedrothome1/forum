@extends('layouts.app')

@section('content')
	<div class="col-md-8 mx-auto">
		<div class="card">

			<div class="card-header">
				Perfil de usuário
			</div>

			<div class="card-body">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="true">Informações</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-details-tab" data-toggle="pill" href="#pills-details" role="tab" aria-controls="pills-details" aria-selected="false">Detalhes</a>
					</li>
				</ul>

				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
						<p>
							<span class="font-weight-bold">Nome: </span><span>{{ $user->name }}</span>
						</p>

						<p>
							<span class="font-weight-bold">Nome de usuário: </span><span>{{ $user->username }}</span>
						</p>

						<p>
							<span class="font-weight-bold">E-mail: </span><span>{{ $user->email }}</span>
						</p>
					</div>

					<div class="tab-pane fade" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
						<p>
							<span class="font-weight-bold">Membro desde: </span><span>{{ $user->created_at->formatLocalized('%d de %B de %Y') }}</span>
						</p>

						<p>
							<span class="font-weight-bold">Tópicos criados: </span><span>{{ count($user->threads) }}</span>
						</p>

						<p>
							<span class="font-weight-bold">Respostas a tópicos: </span><span>{{ count($user->replies) }}</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
