@extends('layouts.app')

@section('content')
<h1>Nova Pergunta para: {{ $categoria->nome }}</h1>
<div class="card shadow-sm col-md-8">
    <div class="card-body">
        <form action="{{ route('admin.perguntas.store', $categoria) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Texto da Pergunta</label>
                <input type="text" name="texto" class="form-control" value="{{ old('texto') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select" id="tipoSelect">
                    <option value="texto" {{ old('tipo') == 'texto' ? 'selected' : '' }}>Texto</option>
                    <option value="multipla_escolha" {{ old('tipo') == 'multipla_escolha' ? 'selected' : '' }}>Múltipla Escolha</option>
                </select>
            </div>
            
            <div id="opcoesContainer" style="{{ old('tipo') === 'multipla_escolha' ? '' : 'display:none;' }}">
                <label class="form-label d-flex justify-content-between align-items-center">
                    Opções da Pergunta
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="addOption()">+ Adicionar Opção</button>
                </label>
                <div id="optionsList" class="mt-2">
                    @if(old('opcoes'))
                        @foreach(old('opcoes') as $index => $opcao)
                            <div class="input-group mb-2 option-item">
                                <input type="text" name="opcoes[]" class="form-control" placeholder="Digite a opção..." value="{{ $opcao }}" {{ old('tipo') !== 'multipla_escolha' ? 'disabled' : '' }}>
                                <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">Remover</button>
                            </div>
                        @endforeach
                    @else
                        <div class="input-group mb-2 option-item">
                            <input type="text" name="opcoes[]" class="form-control" placeholder="Digite a opção..." {{ old('tipo') !== 'multipla_escolha' ? 'disabled' : '' }}>
                            <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">Remover</button>
                        </div>
                    @endif
                </div>
                <small class="text-muted">Adicione pelo menos uma opção para perguntas de múltipla escolha.</small>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Salvar Pergunta</button>
                <a href="{{ route('admin.perguntas.index', $categoria) }}" class="btn btn-link">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const tipoSelect = document.getElementById('tipoSelect');
    const container = document.getElementById('opcoesContainer');

    tipoSelect.addEventListener('change', function() {
        const isMulti = this.value === 'multipla_escolha';
        container.style.display = isMulti ? 'block' : 'none';
        
        // Ativar/Desativar inputs para que não sejam enviados se não for múltipla escolha
        const inputs = container.querySelectorAll('input');
        inputs.forEach(input => {
            input.disabled = !isMulti;
        });

        if (isMulti) {
            const list = document.getElementById('optionsList');
            if (list.children.length === 0) {
                addOption();
            }
        }
    });

    function addOption() {
        const list = document.getElementById('optionsList');
        const div = document.createElement('div');
        div.className = 'input-group mb-2 option-item';
        div.innerHTML = `
            <input type="text" name="opcoes[]" class="form-control" placeholder="Digite a opção...">
            <button type="button" class="btn btn-outline-danger" onclick="removeOption(this)">Remover</button>
        `;
        list.appendChild(div);
        div.querySelector('input').focus();
    }

    function removeOption(btn) {
        const items = document.querySelectorAll('.option-item');
        if (items.length > 1) {
            btn.closest('.option-item').remove();
        } else {
            alert('A pergunta deve ter pelo menos uma opção.');
        }
    }
</script>
@endpush
@endsection
