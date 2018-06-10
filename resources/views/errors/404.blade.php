@extends('layouts.app')

@section('content')

	<div class="mt-5">
		<div class="display-4 text-center text-muted">
			Desculpe, a página que você está procurado não foi encontrada
		</div>
	</div>

	<div class="mt-5 text-center">
		<a class="btn btn-outline-primary" href="{{ route('home') }}">Voltar para a página inicial</a>
	</div>
@endsection