@csrf
<div class="mb-3">
    <label class="form-label">Matrícula</label>
    <input type="text" name="matricula" value="{{ old('matricula', $colaborador->matricula ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="nome" value="{{ old('nome', $colaborador->nome ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Função</label>
    <input type="text" name="funcao" value="{{ old('funcao', $colaborador->funcao ?? '') }}" class="form-control" required>
</div>
<button class="btn btn-success">Salvar</button>
<a href="{{ route('colaboradores.index') }}" class="btn btn-secondary">Cancelar</a>