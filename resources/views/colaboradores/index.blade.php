@extends('layouts.app')
@section('title','Colaboradores')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Colaboradores</h4>
    <a href="{{ route('colaboradores.create') }}" class="btn btn-primary btn-sm">Novo</a>
</div>
<table class="table table-sm table-striped">
    <thead><tr><th>ID</th><th>Matrícula</th><th>Nome</th><th>Função</th><th>Ações</th></tr></thead>
    <tbody>
        @foreach($colaboradores as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->matricula }}</td>
            <td>{{ $c->nome }}</td>
            <td>{{ $c->funcao }}</td>
            <td class="text-nowrap">
                <a href="{{ route('colaboradores.edit',$c) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                <form action="{{ route('colaboradores.destroy',$c) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $colaboradores->links() }}
@endsection