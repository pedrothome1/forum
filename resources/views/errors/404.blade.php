@extends('layouts.app')

@section('content')
	<div class="mt-5">
		<h3 class="text-center">
			<i class="fa fa-frown-o"></i> Desculpe, a página que você está procurado não foi encontrada
		</h3>
	</div>

	<div class="mt-5 text-center">
		<a class="btn btn-outline-primary" href="{{ route('home') }}">Voltar para a página inicial</a>
	</div>
@endsection
