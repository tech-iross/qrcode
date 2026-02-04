@extends('layouts.app')

@section('content')
<h1>Editar Categoria</h1>
<div class="card shadow-sm col-md-6">
    <div class="card-body">
        <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nome da Categoria</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $categoria->nome) }}" required>
            </div>
            <button class="btn btn-primary">Atualizar</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-link">Cancelar</a>
        </form>
    </div>
</div>
@endsection
