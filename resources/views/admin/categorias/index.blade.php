@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Categorias de Produtos</h1>
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">Nova Categoria</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Produtos</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td><span class="badge bg-secondary">{{ $categoria->produtos_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir categoria?')">Excluír</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
