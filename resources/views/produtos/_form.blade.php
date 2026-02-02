@csrf
<div class="mb-3">
    <label class="form-label">Categoria</label>
    <select name="categoria_id" class="form-select">
        <option value="">Sem Categoria</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}" {{ (isset($produto) && $produto->categoria_id == $cat->id) ? 'selected' : '' }}>{{ $cat->nome }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Código (QR)</label>
    <input type="text" name="codigo" value="{{ old('codigo', $produto->codigo ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Número Sequencial</label>
    <input type="text" name="numero_sequencial" value="{{ old('numero_sequencial', $produto->numero_sequencial ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Posto</label>
    <input type="text" name="posto" value="{{ old('posto', $produto->posto ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Linha</label>
    <input type="text" name="linha" value="{{ old('linha', $produto->linha ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Setor</label>
    <input type="text" name="setor" value="{{ old('setor', $produto->setor ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Torque Padrão</label>
    <input type="number" step="0.01" name="torque_padrao" value="{{ old('torque_padrao', $produto->torque_padrao ?? '') }}" class="form-control">
</div>
<button class="btn btn-success">Salvar</button>
<a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>