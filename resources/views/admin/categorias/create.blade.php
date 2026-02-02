@extends('layouts.app')

@section('content')
<h1>Nova Categoria</h1>
<div class="card shadow-sm col-md-6">
    <div class="card-body">
        <form action="{{ route('admin.categorias.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nome da Categoria</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <button class="btn btn-primary">Salvar</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-link">Cancelar</a>
        </form>
    </div>
</div>
@endsection
