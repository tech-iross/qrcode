@extends('layouts.app')

@section('content')
<h1>Nova Pergunta para: {{ $produto->codigo }}</h1>
<div class="card shadow-sm col-md-8">
    <div class="card-body">
        <form action="{{ route('admin.perguntas.store', $produto) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Texto da Pergunta</label>
                <input type="text" name="texto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select" id="tipoSelect">
                    <option value="texto">Texto</option>
                    <option value="multipla_escolha">Múltipla Escolha</option>
                </select>
            </div>
            
            <div id="opcoesContainer" style="display:none;">
                <label class="form-label">Opções (uma por linha)</label>
                <textarea name="opcoes[]" class="form-control" rows="4" placeholder="Opção 1&#10;Opção 2..."></textarea>
                <small class="text-muted">Atenção: Use o campo acima para digitar as opções separadas por linha.</small>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Salvar Pergunta</button>
                <a href="{{ route('admin.perguntas.index', $produto) }}" class="btn btn-link">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('tipoSelect').addEventListener('change', function() {
        document.getElementById('opcoesContainer').style.display = this.value === 'multipla_escolha' ? 'block' : 'none';
    });
</script>
@endpush
@endsection
