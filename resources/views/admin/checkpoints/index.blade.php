@extends('layouts.app')

@section('content')
<h1>Relatório de CheckPoints</h1>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Data</th>
                    <th>Colaborador</th>
                    <th>Produto</th>
                    <th>Duração</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkpoints as $c)
                <tr>
                    <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $c->colaborador->nome }}</td>
                    <td>{{ $c->produto->codigo }}</td>
                    <td>{{ gmdate('H:i:s', $c->duracao) }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.checkpoints.show', $c) }}" class="btn btn-sm btn-outline-primary">Ver Respostas</a>
                        <a href="{{ route('admin.checkpoints.pdf', $c) }}" class="btn btn-sm btn-outline-dark">PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
