@extends('layouts.app')
@section('title','Questionário CheckPoint')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">CheckPoint: {{ $produto->codigo }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('flow.checkpoint.store') }}" method="POST">
                    @csrf
                    
                    @if($produto->categoria->perguntas->isEmpty())
                        <div class="alert alert-warning">Esta categoria de produto não possui perguntas cadastradas. Pode concluir o checkpoint diretamente.</div>
                    @endif

                    @foreach($produto->categoria->perguntas as $pergunta)
                    <div class="mb-4 p-3 border rounded bg-light">
                        <label class="form-label fw-bold">{{ $loop->iteration }}. {{ $pergunta->texto }}</label>
                        
                        @if($pergunta->tipo == 'texto')
                            <input type="text" name="respostas[{{ $pergunta->id }}]" class="form-control" required placeholder="Sua resposta...">
                        @else
                            <div class="mt-2">
                                @foreach($pergunta->opcoes as $opcao)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respostas[{{ $pergunta->id }}]" id="opt{{ $opcao->id }}" value="{{ $opcao->id }}" required>
                                    <label class="form-check-label" for="opt{{ $opcao->id }}">
                                        {{ $opcao->texto }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @endforeach

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">Finalizar CheckPoint</button>
                        <a href="{{ route('flow.index') }}" class="btn btn-link">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
