@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-responsive-sm">
                <thead class="bg-primary">
                <tr>
                    <th class="text-white">Nome</th>
                    <th class="text-white">Cor</th>
                    <th class="text-white">Slug</th>
                    <th class="text-center text-white">Tópicos</th>
                    <th class="text-center text-white">Ação</th>
                </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <i class="fa fa-circle fa-fw" style="color: {{ $category->color }}"></i>  {{ $category->color }}
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td class="text-center">{{ $category->threads()->count() }}</td>
                            <td class="text-center">
                                <a href="/admin/categories/{{ $category->slug }}/edit">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Não há categorias para exibir</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $categories->links('vendor.pagination.bootstrap-4') }}
        </div>

        <div class="col-md-4">
            @include('categories.actions')
        </div>
    </div>
@endsection
