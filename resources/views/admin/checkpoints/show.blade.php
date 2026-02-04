@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Detalhes do CheckPoint #{{ $checkpoint->id }}</h1>
    <a href="{{ route('admin.checkpoints.pdf', $checkpoint) }}" class="btn btn-dark">Baixar PDF</a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">Informações Gerais</div>
            <div class="card-body">
                <p><strong>Colaborador:</strong> {{ $checkpoint->colaborador->nome }} ({{ $checkpoint->colaborador->matricula }})</p>
                <p><strong>Produto:</strong> {{ $checkpoint->produto->codigo }}</p>
                <p><strong>Início:</strong> {{ $checkpoint->started_at?->format('d/m/Y H:i:s') }}</p>
                <p><strong>Fim:</strong> {{ $checkpoint->finished_at?->format('d/m/Y H:i:s') }}</p>
                <p><strong>Duração:</strong> {{ gmdate('H:i:s', $checkpoint->duracao) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">Questionário Respondido</div>
            <div class="card-body">
                @foreach($checkpoint->respostas as $r)
                <div class="mb-3 border-bottom pb-2">
                    <p class="mb-1 text-muted small">Questão {{ $loop->iteration }}</p>
                    <p class="fw-bold mb-1">{{ $r->pergunta->texto }}</p>
                    <p class="mb-0 text-primary">
                        @if($r->pergunta->tipo == 'texto')
                            {{ $r->resposta_texto }}
                        @else
                            {{ $r->opcaoSelecionada ? $r->opcaoSelecionada->texto : 'Opção removida' }}
                        @endif
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('admin.checkpoints.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
