@extends('layouts.app')
@section('title','Produtos')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Produtos (Parafusadeiras)</h4>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary btn-sm">Novo</a>
</div>
<table class="table table-sm table-striped">
    <thead><tr><th>ID</th><th>Código</th><th>QRCode</th><th>Sequencial</th><th>Posto</th><th>Linha</th><th>Setor</th><th>Torque Padrão</th><th>Ações</th></tr></thead>
    <tbody>
        @foreach($produtos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->codigo }}</td>
            <td>
                <a href="{{ route('produtos.qrcode',$p) }}" class="btn btn-sm btn-outline-primary">QR</a>
            </td>
            <td>{{ $p->numero_sequencial }}</td>
            <td>{{ $p->posto }}</td>
            <td>{{ $p->linha }}</td>
            <td>{{ $p->setor }}</td>
            <td>{{ $p->torque_padrao }}</td>
            <td class="text-nowrap">
                <a href="{{ route('admin.perguntas.index',$p) }}" class="btn btn-sm btn-outline-info">Perguntas</a>
                <a href="{{ route('produtos.edit',$p) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                <form action="{{ route('produtos.destroy',$p) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $produtos->links() }}
@endsection