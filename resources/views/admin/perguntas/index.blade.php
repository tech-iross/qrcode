@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Perguntas do Produto: {{ $produto->codigo }}</h1>
    <a href="{{ route('admin.perguntas.create', $produto) }}" class="btn btn-primary">Nova Pergunta</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Pergunta</th>
                    <th>Tipo</th>
                    <th>Opções</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perguntas as $pergunta)
                <tr>
                    <td>{{ $pergunta->texto }}</td>
                    <td>{{ ucfirst($pergunta->tipo) }}</td>
                    <td>
                        @if($pergunta->tipo == 'multipla_escolha')
                            @foreach($pergunta->opcoes as $opcao)
                                <span class="badge bg-info text-dark">{{ $opcao->texto }}</span>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-end">
                        <form action="{{ route('admin.perguntas.destroy', $pergunta) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir pergunta?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar para Produtos</a>
</div>
@endsection
