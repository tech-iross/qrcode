@extends('layouts.app')
@section('title','Usuários')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Usuários</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Novo</a>
</div>
<table class="table table-sm table-striped">
    <thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Criado em</th><th>Ações</th></tr></thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->created_at->format('d/m/Y H:i') }}</td>
            <td class="text-nowrap">
                <a href="{{ route('users.edit',$u) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                <form action="{{ route('users.destroy',$u) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection
